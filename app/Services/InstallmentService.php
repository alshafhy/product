<?php

namespace App\Services;

use App\Models\Installment;
use App\Models\SaleInvoice;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InstallmentService
{
    /**
     * Generate an installment schedule for a sale invoice.
     */
    public function generateSchedule(SaleInvoice $invoice, int $count, Carbon $firstDue): Collection
    {
        return DB::transaction(function () use ($invoice, $count, $firstDue) {
            $totalAmount = (string) $invoice->remaining;
            
            // Calculate equal installment amount
            $installmentAmount = bcdiv($totalAmount, (string) $count, 4);
            
            // Calculate the remainder to add to the last installment
            // remainder = total - (installmentAmount * (count - 1))
            $sumOfFirstNMinus1 = bcmul($installmentAmount, (string) ($count - 1), 4);
            $lastInstallmentAmount = bcsub($totalAmount, $sumOfFirstNMinus1, 4);

            $installments = collect();

            for ($i = 0; $i < $count; $i++) {
                $isLast = ($i === $count - 1);
                $amount = $isLast ? $lastInstallmentAmount : $installmentAmount;
                
                $installments->push(Installment::create([
                    'sale_invoice_id' => $invoice->id,
                    'customer_id' => $invoice->customer_id,
                    'amount' => $amount,
                    'due_date' => $firstDue->copy()->addMonths($i)->toDateString(),
                    'status' => 'not_paid',
                    'created_by' => auth()->id(),
                ]));
            }

            return $installments;
        });
    }

    /**
     * Mark an installment as paid and record in treasury.
     */
    public function markAsPaid(Installment $installment, string $paidDate): void
    {
        DB::transaction(function () use ($installment, $paidDate) {
            $installment->update([
                'status' => 'paid',
                'paid_date' => $paidDate,
            ]);

            // record in treasury box
            $treasuryService = app(TreasuryService::class);
            $treasuryService->deposit([
                'branch_id' => $installment->saleInvoice->branch_id,
                'user_id' => auth()->id(),
                'amount' => (string) $installment->amount,
                'reference_type' => Installment::class,
                'reference_id' => $installment->id,
                'description' => "Installment payment for Invoice #{$installment->saleInvoice->invoice_number}",
                'transacted_at' => $paidDate,
                'created_by' => auth()->id(),
            ]);

            // Update customer balance if necessary
            if ($installment->customer) {
                $installment->customer->recalculateBalance();
            }
        });
    }

    /**
     * Get report of all overdue installments.
     */
    public function getOverdueReport(int $branchId): Collection
    {
        return Installment::whereHas('saleInvoice', function($q) use ($branchId) {
                $q->where('branch_id', $branchId);
            })
            ->overdue()
            ->with(['customer', 'saleInvoice'])
            ->get();
    }

    /**
     * Get total overdue amount for a customer using BCMath.
     */
    public function getTotalOverdue(int $customerId): string
    {
        $overdueInstallments = Installment::forCustomer($customerId)
            ->overdue()
            ->get();

        $total = '0';
        foreach ($overdueInstallments as $installment) {
            $total = bcadd($total, (string) $installment->amount, 4);
        }

        return $total;
    }
}
