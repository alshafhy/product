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

    // ── Type constants — mirrors Android operations ───────────────
    const TYPE_OPENING_BALANCE  = 'opening_balance';
    const TYPE_DEPOSIT          = 'deposit';
    const TYPE_WITHDRAWAL       = 'withdrawal';
    const TYPE_EXPENSE          = 'expense';
    const TYPE_SALE_PAYMENT     = 'sale_payment';
    const TYPE_PURCHASE_PAYMENT = 'purchase_payment';

    // Types that ADD to balance
    const CREDIT_TYPES = [
        self::TYPE_OPENING_BALANCE,
        self::TYPE_DEPOSIT,
        self::TYPE_SALE_PAYMENT,
    ];

    // Types that SUBTRACT from balance
    const DEBIT_TYPES = [
        self::TYPE_WITHDRAWAL,
        self::TYPE_EXPENSE,
        self::TYPE_PURCHASE_PAYMENT,
    ];

    protected $fillable = [
        'branch_id',
        'type',
        'amount',
        'balance_before',
        'balance_after',
        'reference_type',
        'reference_id',
        'notes',
        'transaction_date',
        'created_by',
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
            ->logFillable()
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $e) => "TreasuryTransaction {$e}");
    }

    // ── Relations ────────────────────────────────────────────────
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Polymorphic relation to source document (invoice etc.)
     */
    public function reference(): MorphTo
    {
        return $this->morphTo('reference');
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

    public function scopeDateBetween($query, string $from, string $to)
    {
        return $query->whereBetween('transaction_date', [$from, $to]);
    }

    public function scopeCredits($query)
    {
        return $query->whereIn('type', self::CREDIT_TYPES);
    }

    public function scopeDebits($query)
    {
        return $query->whereIn('type', self::DEBIT_TYPES);
    }

    // ── Accessors ─────────────────────────────────────────────────
    public function getIsExpenseAttribute(): bool
    {
        return $this->type === self::TYPE_EXPENSE;
    }

    public function getIsCreditAttribute(): bool
    {
        return in_array($this->type, self::CREDIT_TYPES);
    }

    public function getTypeArabicAttribute(): string
    {
        return match ($this->type) {
            self::TYPE_OPENING_BALANCE  => 'رصيد افتتاحي',
            self::TYPE_DEPOSIT          => 'إيداع',
            self::TYPE_WITHDRAWAL       => 'سحب',
            self::TYPE_EXPENSE          => 'مصروف',
            self::TYPE_SALE_PAYMENT     => 'تحصيل مبيعات',
            self::TYPE_PURCHASE_PAYMENT => 'دفعة مشتريات',
            default                     => $this->type,
        };
    }
}
