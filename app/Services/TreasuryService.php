<?php

namespace App\Services;

use App\Models\PurchaseInvoice;
use App\Models\SaleInvoice;
use App\Models\TreasuryTransaction;
use Illuminate\Support\Facades\DB;
use Exception;

class TreasuryService extends BaseService
{
    private int $scale = 4;

    /**
     * Get the current balance of the treasury for a specific branch.
     */
    public function getBalance(int $branchId): float
    {
        $transactions = TreasuryTransaction::where('branch_id', $branchId)->get();
        
        $balance = '0.0000';
        
        foreach ($transactions as $transaction) {
            $amount = (string) $transaction->amount;
            
            if (in_array($transaction->type, ['deposit', 'sale_receipt'])) {
                $balance = bcadd($balance, $amount, $this->scale);
            } else {
                $balance = bcsub($balance, $amount, $this->scale);
            }
        }
        
        return (float) $balance;
    }

    /**
     * Record a manual deposit.
     */
    public function deposit(array $data): TreasuryTransaction
    {
        $data['type'] = 'deposit';
        return TreasuryTransaction::create($data);
    }

    /**
     * Record a manual withdrawal or expense.
     */
    public function withdraw(array $data): TreasuryTransaction
    {
        // Optional: Check balance before withdrawal
        // $currentBalance = $this->getBalance($data['branch_id']);
        // if (bccomp((string)$currentBalance, (string)$data['amount'], $this->scale) === -1) {
        //     throw new Exception("Insufficient balance in treasury.");
        // }

        return TreasuryTransaction::create($data);
    }

    /**
     * Automatically record payment received from a sale invoice.
     */
    public function recordFromSaleInvoice(SaleInvoice $invoice): ?TreasuryTransaction
    {
        if ((float) $invoice->paid <= 0) {
            return null;
        }

        return TreasuryTransaction::create([
            'branch_id' => $invoice->branch_id,
            'user_id' => $invoice->user_id,
            'type' => 'sale_receipt',
            'amount' => $invoice->paid,
            'reference_type' => SaleInvoice::class,
            'reference_id' => $invoice->id,
            'description' => "Payment received for Invoice #{$invoice->invoice_number}",
            'transacted_at' => $invoice->invoiced_at,
            'created_by' => $invoice->created_by,
        ]);
    }

    /**
     * Automatically record payment made for a purchase invoice.
     */
    public function recordFromPurchaseInvoice(PurchaseInvoice $invoice): ?TreasuryTransaction
    {
        if ((float) $invoice->paid <= 0) {
            return null;
        }

        return TreasuryTransaction::create([
            'branch_id' => $invoice->branch_id,
            'user_id' => $invoice->user_id,
            'type' => 'purchase_payment',
            'amount' => $invoice->paid,
            'reference_type' => PurchaseInvoice::class,
            'reference_id' => $invoice->id,
            'description' => "Payment made for Purchase Invoice #{$invoice->invoice_number}",
            'transacted_at' => $invoice->invoiced_at,
            'created_by' => $invoice->created_by,
        ]);
    }
}
