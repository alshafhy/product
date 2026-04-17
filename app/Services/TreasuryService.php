<?php

namespace App\Services;

use App\Models\TreasuryTransaction;
use App\Models\SaleInvoice;
use App\Models\PurchaseInvoice;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TreasuryService
{
    /**
     * Get the current balance for a branch.
     */
    public function getBalance(int $branchId): string
    {
        $transactions = TreasuryTransaction::where('branch_id', $branchId)->get();
        
        $balance = '0';
        foreach ($transactions as $tx) {
            if (in_array($tx->type, ['deposit', 'sale_receipt'])) {
                $balance = bcadd($balance, (string) $tx->amount, 4);
            } else {
                $balance = bcsub($balance, (string) $tx->amount, 4);
            }
        }

        return $balance;
    }

    /**
     * Record a cash deposit.
     */
    public function deposit(array $data): TreasuryTransaction
    {
        return TreasuryTransaction::create(array_merge($data, [
            'type' => 'deposit',
            'transacted_at' => $data['transacted_at'] ?? now(),
        ]));
    }

    /**
     * Record a cash withdrawal with balance validation.
     */
    public function withdraw(array $data): TreasuryTransaction
    {
        $currentBalance = $this->getBalance($data['branch_id']);
        
        if (bccomp((string) $data['amount'], $currentBalance, 4) === 1) {
            throw new \Exception("Insufficient treasury balance for withdrawal. Current: {$currentBalance}");
        }

        return TreasuryTransaction::create(array_merge($data, [
            'type' => 'withdrawal',
            'transacted_at' => $data['transacted_at'] ?? now(),
        ]));
    }

    /**
     * Automatically record payment received from a sale invoice.
     */
    public function recordFromSaleInvoice(SaleInvoice $invoice): TreasuryTransaction
    {
        return TreasuryTransaction::create([
            'branch_id' => $invoice->branch_id,
            'user_id' => $invoice->user_id,
            'type' => 'sale_receipt',
            'amount' => (string) $invoice->paid,
            'reference_type' => SaleInvoice::class,
            'reference_id' => $invoice->id,
            'description' => "Receipt for Invoice #{$invoice->invoice_number}",
            'transacted_at' => $invoice->invoiced_at,
            'created_by' => $invoice->created_by,
        ]);
    }

    /**
     * Automatically record payment made for a purchase invoice.
     */
    public function recordFromPurchaseInvoice(PurchaseInvoice $invoice): TreasuryTransaction
    {
        return TreasuryTransaction::create([
            'branch_id' => $invoice->branch_id,
            'user_id' => $invoice->user_id,
            'type' => 'purchase_payment',
            'amount' => (string) $invoice->paid,
            'reference_type' => PurchaseInvoice::class,
            'reference_id' => $invoice->id,
            'description' => "Payment for Purchase #{$invoice->invoice_number}",
            'transacted_at' => $invoice->invoiced_at,
            'created_by' => $invoice->created_by,
        ]);
    }

    /**
     * Generate a daily treasury report for a branch.
     */
    public function getDailyReport(Carbon $date, int $branchId): array
    {
        $txs = TreasuryTransaction::forBranch($branchId)->forDate($date)->get();
        
        $totalIn = '0';
        $totalOut = '0';

        foreach ($txs as $tx) {
            if (in_array($tx->type, ['deposit', 'sale_receipt'])) {
                $totalIn = bcadd($totalIn, (string) $tx->amount, 4);
            } else {
                $totalOut = bcadd($totalOut, (string) $tx->amount, 4);
            }
        }

        return [
            'date' => $date->toDateString(),
            'total_in' => $totalIn,
            'total_out' => $totalOut,
            'net_flow' => bcsub($totalIn, $totalOut, 4),
            'transactions' => $txs,
        ];
    }
}
