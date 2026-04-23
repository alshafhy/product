<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Installment;
use App\Models\SaleInvoice;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class InstallmentService
{
    public function __construct(
        private readonly TreasuryService $treasuryService
    ) {}

    /**
     * Create installments for an invoice.
     * Called after a sale invoice is created with payment_type = 'credit' or 'partial'.
     *
     * Validates: sum of all installment amounts == invoice remaining_amount.
     *
     * @param  SaleInvoice  $invoice
     * @param  array        $installments  Each: [collect_date, amount, description?, guarantor_name?, guarantor_phone?, days_limit?]
     * @return Collection<Installment>
     */
    public function createForInvoice(SaleInvoice $invoice, array $installments): Collection
    {
        if (empty($installments)) {
            throw new \InvalidArgumentException('يجب إضافة قسط واحد على الأقل.');
        }

        // ── Validate total matches invoice remaining ──────────────
        $sum = array_reduce(
            $installments,
            fn(string $carry, array $item) => bcadd($carry, (string) $item['amount'], 4),
            '0.0000'
        );

        if (bccomp($sum, (string) $invoice->remaining_amount, 4) !== 0) {
            throw new \InvalidArgumentException(
                "مجموع الأقساط ({$sum}) لا يساوي المبلغ المتبقي ({$invoice->remaining_amount})."
            );
        }

        return DB::transaction(function () use ($invoice, $installments) {
            $created = collect();

            foreach ($installments as $item) {
                $installment = Installment::create([
                    'sale_invoice_id' => $invoice->id,
                    'customer_id'     => $invoice->customer_id,
                    'client_name'     => $invoice->customer_name ?? 'عميل نقدي',
                    'description'     => $item['description']      ?? null,
                    'days_limit'      => $item['days_limit']        ?? 0,
                    'collect_date'    => $item['collect_date'],
                    'amount'          => $item['amount'],
                    'status'          => Installment::STATUS_NOT_PAID,
                    'guarantor_name'  => $item['guarantor_name']   ?? null,
                    'guarantor_phone' => $item['guarantor_phone']  ?? null,
                    'created_by'      => auth()->id(),
                ]);

                $created->push($installment);
            }

            return $created;
        });
    }

    /**
     * Collect (pay) a single installment.
     * Maps Android: pay_money dialog → sets statue=paid, paydate=today
     *
     * Flow:
     *  1. Mark installment as paid
     *  2. Record in treasury as deposit (sale_payment)
     *  3. Update customer paid_amount
     *  All inside DB::transaction with lockForUpdate
     */
    public function collect(Installment $installment, array $data): Installment
    {
        if ($installment->status === Installment::STATUS_PAID) {
            throw new \RuntimeException('هذا القسط مدفوع بالفعل.');
        }

        return DB::transaction(function () use ($installment, $data) {

            // Lock the installment row
            $installment = Installment::lockForUpdate()->findOrFail($installment->id);

            // ── 1. Mark as paid ───────────────────────────────────
            $installment->update([
                'status'     => Installment::STATUS_PAID,
                'paid_date'  => $data['paid_date'] ?? today(),
                'pay_type'   => $data['pay_type']  ?? 'cash',
                'updated_by' => auth()->id(),
            ]);

            // ── 2. Record in treasury ─────────────────────────────
            $branchId = $installment->saleInvoice->branch_id;

            $this->treasuryService->deposit([
                'branch_id'        => $branchId,
                'amount'           => $installment->amount,
                'notes'            => "تحصيل قسط - {$installment->client_name} - فاتورة: {$installment->saleInvoice->invoice_number}",
                'reference_type'   => 'sale_invoice',
                'reference_id'     => $installment->sale_invoice_id,
                'transaction_date' => $data['paid_date'] ?? today(),
                'created_by'       => auth()->id(),
            ]);

            // ── 3. Update customer paid_amount ────────────────────
            if ($installment->customer_id) {
                $customer = Customer::lockForUpdate()->findOrFail($installment->customer_id);
                $customer->recordPayment((float) $installment->amount);
            }

            return $installment->fresh();
        });
    }

    /**
     * Get all overdue installments for a branch.
     * Maps Android latekists screen — shows kists where today > collectdate.
     */
    public function getOverdue(int $branchId): Collection
    {
        return Installment::forBranch($branchId)
            ->overdue()
            ->with(['saleInvoice', 'customer'])
            ->orderBy('collect_date')
            ->get();
    }

    /**
     * Get installment summary for a customer.
     * Maps Android omalkist screen totals.
     */
    public function getCustomerSummary(int $customerId): array
    {
        $installments = Installment::forCustomer($customerId)
            ->with('saleInvoice')
            ->get();

        $totalPaid   = $installments->where('status', Installment::STATUS_PAID)->count();
        $totalUnpaid = $installments->where('status', Installment::STATUS_NOT_PAID)->count();

        $totalAmount = $installments
            ->where('status', Installment::STATUS_NOT_PAID)
            ->reduce(
                fn(string $carry, Installment $k) => bcadd($carry, (string) $k->amount, 4),
                '0.0000'
            );

        return [
            'total'        => $installments->count(),
            'paid_count'   => $totalPaid,
            'unpaid_count' => $totalUnpaid,
            'unpaid_total' => $totalAmount,
        ];
    }
}
