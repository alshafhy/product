<?php

namespace App\Services;

use App\Models\Installment;
use App\Models\SaleInvoice;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class InstallmentService
{
    protected TreasuryService $treasury;

    public function __construct(TreasuryService $treasury)
    {
        $this->treasury = $treasury;
    }

    /**
     * Create scheduled installments for an invoice.
     * Validates that total installment amount matches the invoice remaining balance.
     */
    public function createForInvoice(SaleInvoice $invoice, array $installmentsData): Collection
    {
        if (empty($installmentsData)) {
            throw new \InvalidArgumentException('No installments provided.');
        }

        // Validate total amount
        $totalInstallments = '0.0000';
        foreach ($installmentsData as $data) {
            $totalInstallments = bcadd($totalInstallments, (string) $data['amount'], 4);
        }

        if (bccomp($totalInstallments, (string) $invoice->remaining_amount, 4) !== 0) {
            throw new \RuntimeException(
                "Total installments ({$totalInstallments}) must match invoice remaining amount ({$invoice->remaining_amount})."
            );
        }

        return DB::transaction(function () use ($invoice, $installmentsData) {
            $created = new Collection();

            foreach ($installmentsData as $data) {
                $created->push(Installment::create([
                    'sale_invoice_id' => $invoice->id,
                    'customer_id'     => $invoice->customer_id,
                    'client_name'     => $invoice->customer_name ?? $invoice->customer?->name,
                    'description'     => $data['description'] ?? null,
                    'days_limit'      => $data['days_limit']  ?? 0,
                    'collect_date'    => $data['collect_date'],
                    'amount'          => $data['amount'],
                    'status'          => Installment::STATUS_NOT_PAID,
                    'guarantor_name'  => $data['guarantor_name']  ?? null,
                    'guarantor_phone' => $data['guarantor_phone'] ?? null,
                    'created_by'      => auth()->id(),
                ]));
            }

            return $created;
        });
    }

    /**
     * Collect payment for an installment.
     * Updates status, records treasury deposit, and updates customer balance.
     */
    public function collect(Installment $installment, array $data): Installment
    {
        if ($installment->status === Installment::STATUS_PAID) {
            throw new \RuntimeException('Installment is already paid.');
        }

        return DB::transaction(function () use ($installment, $data) {
            $installment->lockForUpdate();

            // 1. Update installment status
            $installment->update([
                'status'    => Installment::STATUS_PAID,
                'paid_date' => now()->toDateString(),
                'pay_type'  => $data['pay_type'] ?? 'cash',
                'updated_by' => auth()->id(),
            ]);

            // 2. Record in Treasury
            $this->treasury->recordFromSale(
                $installment->saleInvoice,
                (float) $installment->amount
            );

            // 3. Update Sale Invoice (marks as paid if all installments done)
            $installment->saleInvoice->recordPayment((float) $installment->amount);

            // 4. Update Customer balance
            if ($installment->customer) {
                $installment->customer->recordPayment((float) $installment->amount);
            }

            return $installment->fresh();
        });
    }
}
