<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class TreasuryTransaction extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    // Transaction Types
    const TYPE_DEPOSIT          = 'deposit';
    const TYPE_WITHDRAWAL       = 'withdrawal';
    const TYPE_EXPENSE          = 'expense';
    const TYPE_SALE_PAYMENT     = 'sale_payment';
    const TYPE_PURCHASE_PAYMENT = 'purchase_payment';
    const TYPE_OPENING_BALANCE  = 'opening_balance';

    protected $fillable = [
        'branch_id',
        'type',
        'amount',
        'balance_before',
        'balance_after',
        'reference_type',
        'reference_id',
        'transaction_date',
        'notes',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'amount'           => 'decimal:4',
        'balance_before'   => 'decimal:4',
        'balance_after'    => 'decimal:4',
        'transaction_date' => 'date',
    ];

    // ── Activity Log ─────────────────────────────────────────────
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['type', 'amount', 'balance_after'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $e) => "TreasuryTransaction {$e}");
    }

    // ── Relations ────────────────────────────────────────────────
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function reference(): MorphTo
    {
        return $this->morphTo();
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // ── Scopes ───────────────────────────────────────────────────
    public function scopeForBranch($query, int $branchId)
    {
        return $query->where('branch_id', $branchId);
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeDateRange($query, string $from, string $to)
    {
        return $query->whereBetween('transaction_date', [$from, $to]);
    }

    public function scopeForReference($query, string $type, int $id)
    {
        return $query->where('reference_type', $type)
                     ->where('reference_id', $id);
    }

    // ── Accessors ────────────────────────────────────────────────
    public function getIsExpenseAttribute(): bool
    {
        return in_array($this->type, [self::TYPE_EXPENSE, self::TYPE_WITHDRAWAL, self::TYPE_PURCHASE_PAYMENT]);
    }

    public function getIsIncomeAttribute(): bool
    {
        return in_array($this->type, [self::TYPE_DEPOSIT, self::TYPE_SALE_PAYMENT, self::TYPE_OPENING_BALANCE]);
    }
}
