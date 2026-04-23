<?php

namespace App\Services;

use App\Models\PurchaseInvoice;
use App\Models\SaleInvoice;
use App\Models\TreasuryTransaction;
use Illuminate\Support\Facades\DB;

class TreasuryService
{
    /**
     * Get current balance for a branch.
     * Uses the last balance_after record.
     */
    public function currentBalance(int $branchId): string
    {
        $lastTransaction = TreasuryTransaction::where('branch_id', $branchId)
            ->orderBy('id', 'desc')
            ->first();

        return $lastTransaction ? (string) $lastTransaction->balance_after : '0.0000';
    }

    /**
     * Cash Deposit.
     */
    public function deposit(array $data): TreasuryTransaction
    {
        return $this->createTransaction(
            $data['branch_id'],
            TreasuryTransaction::TYPE_DEPOSIT,
            $data['amount'],
            $data
        );
    }

    /**
     * Cash Withdrawal.
     */
    public function withdraw(array $data): TreasuryTransaction
    {
        $currentBalance = $this->currentBalance($data['branch_id']);
        if (bccomp($currentBalance, (string) $data['amount'], 4) < 0) {
            throw new \RuntimeException("Insufficient treasury balance. Current: {$currentBalance}");
        }

        return $this->createTransaction(
            $data['branch_id'],
            TreasuryTransaction::TYPE_WITHDRAWAL,
            $data['amount'],
            $data
        );
    }

    /**
     * Business Expense.
     */
    public function expense(array $data): TreasuryTransaction
    {
        return $this->createTransaction(
            $data['branch_id'],
            TreasuryTransaction::TYPE_EXPENSE,
            $data['amount'],
            $data
        );
    }

    /**
     * Automatic record from a Sale Invoice payment.
     */
    public function recordFromSale(SaleInvoice $invoice, float $paidAmount): TreasuryTransaction
    {
        return $this->createTransaction(
            $invoice->branch_id,
            TreasuryTransaction::TYPE_SALE_PAYMENT,
            $paidAmount,
            [
                'reference_type' => SaleInvoice::class,
                'reference_id'   => $invoice->id,
                'notes'          => "Payment received for invoice #{$invoice->invoice_number}",
                'created_by'     => $invoice->cashier_id,
            ]
        );
    }

    /**
     * Automatic record from a Purchase Invoice payment.
     */
    public function recordFromPurchase(PurchaseInvoice $invoice, float $paidAmount): TreasuryTransaction
    {
        return $this->createTransaction(
            $invoice->branch_id,
            TreasuryTransaction::TYPE_PURCHASE_PAYMENT,
            $paidAmount,
            [
                'reference_type' => PurchaseInvoice::class,
                'reference_id'   => $invoice->id,
                'notes'          => "Payment made for purchase #{$invoice->invoice_number}",
                'created_by'     => $invoice->cashier_id,
            ]
        );
    }

    /**
     * Base transaction creator — ensures atomic balance updates.
     */
    protected function createTransaction(
        int $branchId,
        string $type,
        float $amount,
        array $extra = []
    ): TreasuryTransaction {
        return DB::transaction(function () use ($branchId, $type, $amount, $extra) {
            
            // 1. Lock last transaction for this branch to prevent race conditions
            // This effectively serializes treasury operations per branch.
            $last = TreasuryTransaction::where('branch_id', $branchId)
                ->lockForUpdate()
                ->orderBy('id', 'desc')
                ->first();

            $before = $last ? (string) $last->balance_after : '0.0000';
            $amountStr = (string) $amount;

            // 2. Determine if amount adds or subtracts
            $isIncome = in_array($type, [
                TreasuryTransaction::TYPE_DEPOSIT,
                TreasuryTransaction::TYPE_SALE_PAYMENT,
                TreasuryTransaction::TYPE_OPENING_BALANCE
            ]);

            $after = $isIncome 
                ? bcadd($before, $amountStr, 4)
                : bcsub($before, $amountStr, 4);

            // 3. Persist
            return TreasuryTransaction::create([
                'branch_id'        => $branchId,
                'type'             => $type,
                'amount'           => $amountStr,
                'balance_before'   => $before,
                'balance_after'    => $after,
                'reference_type'   => $extra['reference_type'] ?? null,
                'reference_id'     => $extra['reference_id']   ?? null,
                'transaction_date' => $extra['transaction_date'] ?? now()->toDateString(),
                'notes'            => $extra['notes'] ?? null,
                'created_by'       => $extra['created_by'] ?? auth()->id(),
            ]);
        });
    }
}
