<?php

namespace App\Services;

use App\Models\SaleInvoice;
use App\Models\PurchaseInvoice;
use App\Models\TreasuryTransaction;
use Illuminate\Support\Facades\DB;

class TreasuryService
{
    // ── Core Balance Reader ───────────────────────────────────────

    /**
     * Get current balance for a branch.
     * Reads the last balance_after — mirrors Android's j() cursor pattern.
     * Uses lockForUpdate() when called inside a transaction.
     */
    public function currentBalance(int $branchId, bool $lock = false): string
    {
        $query = TreasuryTransaction::forBranch($branchId)
            ->orderByDesc('id')
            ->limit(1);

        if ($lock) {
            $query->lockForUpdate();
        }

        $last = $query->first();

        return $last ? (string) $last->balance_after : '0.0000';
    }

    // ── Public Transaction Methods ────────────────────────────────

    /**
     * Set opening balance for a branch (first-time setup).
     * Maps Android's initial treasury state.
     */
    public function setOpeningBalance(int $branchId, float $amount, int $userId): TreasuryTransaction
    {
        return DB::transaction(function () use ($branchId, $amount, $userId) {
            return $this->record([
                'branch_id'        => $branchId,
                'type'             => TreasuryTransaction::TYPE_OPENING_BALANCE,
                'amount'           => $amount,
                'notes'            => 'رصيد افتتاحي',
                'transaction_date' => today(),
                'created_by'       => $userId,
            ]);
        });
    }

    /**
     * Deposit cash into treasury.
     * Maps Android: إضافة للخزينة → balance_after = balance_before + amount
     */
    public function deposit(array $data): TreasuryTransaction
    {
        return DB::transaction(function () use ($data) {
            return $this->record(array_merge($data, [
                'type' => TreasuryTransaction::TYPE_DEPOSIT,
            ]));
        });
    }

    /**
     * Withdraw cash from treasury.
     * Maps Android: خصم من الخزينة → balance_after = balance_before - amount
     * Throws if balance insufficient.
     */
    public function withdraw(array $data): TreasuryTransaction
    {
        return DB::transaction(function () use ($data) {
            $balance = $this->currentBalance($data['branch_id'], lock: true);

            if (bccomp((string) $data['amount'], $balance, 4) > 0) {
                throw new \RuntimeException(
                    "رصيد الخزينة غير كافٍ. الرصيد الحالي: {$balance}"
                );
            }

            return $this->record(array_merge($data, [
                'type' => TreasuryTransaction::TYPE_WITHDRAWAL,
            ]));
        });
    }

    /**
     * Record an expense from treasury.
     * Maps Android: مصروف → prefixes notes with "مصروف:"
     */
    public function expense(array $data): TreasuryTransaction
    {
        return DB::transaction(function () use ($data) {
            $balance = $this->currentBalance($data['branch_id'], lock: true);

            if (bccomp((string) $data['amount'], $balance, 4) > 0) {
                throw new \RuntimeException(
                    "رصيد الخزينة غير كافٍ لتسجيل المصروف."
                );
            }

            return $this->record(array_merge($data, [
                'type'  => TreasuryTransaction::TYPE_EXPENSE,
                'notes' => 'مصروف: ' . ($data['notes'] ?? ''),
            ]));
        });
    }

    /**
     * Record sale payment received into treasury.
     * Called automatically by SaleInvoiceService.
     * Maps Android: تحصيل مبيعات
     */
    public function recordFromSale(
        SaleInvoice $invoice,
        float $paidAmount,
        int $userId
    ): TreasuryTransaction {
        return $this->record([
            'branch_id'        => $invoice->branch_id,
            'type'             => TreasuryTransaction::TYPE_SALE_PAYMENT,
            'amount'           => $paidAmount,
            'reference_type'   => 'sale_invoice',
            'reference_id'     => $invoice->id,
            'notes'            => "تحصيل فاتورة مبيعات: {$invoice->invoice_number}",
            'transaction_date' => $invoice->invoice_date,
            'created_by'       => $userId,
        ]);
    }

    /**
     * Record purchase payment paid out from treasury.
     * Called automatically by PurchaseInvoiceService.
     */
    public function recordFromPurchase(
        PurchaseInvoice $invoice,
        float $paidAmount,
        int $userId
    ): TreasuryTransaction {
        $balance = $this->currentBalance($invoice->branch_id, lock: true);

        if (bccomp((string) $paidAmount, $balance, 4) > 0) {
            throw new \RuntimeException(
                "رصيد الخزينة غير كافٍ لتسجيل دفعة المشتريات."
            );
        }

        return $this->record([
            'branch_id'        => $invoice->branch_id,
            'type'             => TreasuryTransaction::TYPE_PURCHASE_PAYMENT,
            'amount'           => $paidAmount,
            'reference_type'   => 'purchase_invoice',
            'reference_id'     => $invoice->id,
            'notes'            => "دفعة فاتورة مشتريات: {$invoice->invoice_number}",
            'transaction_date' => $invoice->invoice_date,
            'created_by'       => $userId,
        ]);
    }

    // ── Private Core ──────────────────────────────────────────────

    /**
     * Core record method — always called inside a DB::transaction.
     * Reads current balance with lock, computes before/after, persists.
     * This is the single source of truth for all treasury writes.
     */
    private function record(array $data): TreasuryTransaction
    {
        $balanceBefore = $this->currentBalance($data['branch_id'], lock: true);

        // Determine direction: credit types add, debit types subtract
        $type = $data['type'];

        $balanceAfter = in_array($type, TreasuryTransaction::CREDIT_TYPES)
            ? bcadd($balanceBefore, (string) $data['amount'], 4)
            : bcsub($balanceBefore, (string) $data['amount'], 4);

        return TreasuryTransaction::create(array_merge($data, [
            'balance_before'   => $balanceBefore,
            'balance_after'    => $balanceAfter,
            'transaction_date' => $data['transaction_date'] ?? today(),
        ]));
    }
}
