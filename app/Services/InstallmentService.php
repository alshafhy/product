<?php

namespace App\Services;

use App\Models\Installment;
use App\Models\SaleInvoice;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;

class InstallmentService extends BaseService
{
    private int $scale = 4;

    /**
     * Generate an installment schedule for a sale invoice.
     */
    public function generateSchedule(SaleInvoice $invoice, int $count, string $firstDue): Collection
    {
        if ($count <= 0) {
            throw new Exception("Installment count must be greater than zero.");
        }

        $remainingAmount = (string) $invoice->remaining;
        
        // Calculate base amount per installment
        $baseAmount = bcdiv($remainingAmount, (string) $count, $this->scale);
        
        // Calculate the remainder that might be lost due to division rounding
        $calculatedTotal = bcmul($baseAmount, (string) $count, $this->scale);
        $diff = bcsub($remainingAmount, $calculatedTotal, $this->scale);

        $installments = new Collection();
        $startDate = Carbon::parse($firstDue);

        return DB::transaction(function () use ($invoice, $count, $baseAmount, $diff, $startDate, $installments) {
            for ($i = 0; $i < $count; $i++) {
                $amount = ($i === 0) ? bcadd($baseAmount, $diff, $this->scale) : $baseAmount;
                
                $installment = Installment::create([
                    'sale_invoice_id' => $invoice->id,
                    'customer_id' => $invoice->customer_id,
                    'amount' => $amount,
                    'due_date' => $startDate->copy()->addMonths($i),
                    'status' => 'not_paid',
                    'created_by' => auth()->id() ?? $invoice->created_by,
                ]);
                
                $installments->push($installment);
            }
            
            return $installments;
        });
    }

    /**
     * Mark an installment as paid.
     */
    public function markAsPaid(Installment $installment, string $paidDate): void
    {
        DB::transaction(function () use ($installment, $paidDate) {
            $installment->update([
                'status' => 'paid',
                'paid_date' => Carbon::parse($paidDate),
                'payment_type' => 'cash', // Default
            ]);

            // Update associated invoice 'paid' and 'remaining' amounts
            if ($installment->saleInvoice) {
                $invoice = $installment->saleInvoice;
                $newPaid = bcadd((string)$invoice->paid, (string)$installment->amount, $this->scale);
                $newRemaining = bcsub((string)$invoice->remaining, (string)$installment->amount, $this->scale);
                
                $invoice->update([
                    'paid' => $newPaid,
                    'remaining' => $newRemaining,
                ]);

                // Also potentially handle customer balance decrement if handleDebt logic was used
                if ($invoice->customer) {
                    $invoice->customer->decrement('current_balance', $installment->amount);
                }
            }
        });
    }

    /**
     * Get report of overdue installments for a specific branch.
     */
    public function getOverdueReport(int $branchId): Collection
    {
        return Installment::whereHas('saleInvoice', function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        })->overdue()->get();
    }
}
