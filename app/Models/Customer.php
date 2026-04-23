<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Customer extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'branch_id',
        'name',
        'phone',
        'address',
        'notes',
        'paid_amount',
        'total_invoiced',
        'credit_limit',
        'price_type',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'paid_amount'     => 'decimal:4',
        'total_invoiced'  => 'decimal:4',
        'credit_limit'    => 'decimal:4',
        'price_type'      => 'integer',
        'is_active'       => 'boolean',
    ];

    // ── Activity Log ─────────────────────────────────────────────
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $e) => "Customer {$e}");
    }

    // ── Relations ────────────────────────────────────────────────
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function saleInvoices(): HasMany
    {
        return $this->hasMany(SaleInvoice::class);
    }

    public function installments(): HasMany
    {
        return $this->hasMany(Installment::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // ── Accessors ─────────────────────────────────────────────────

    /**
     * Current debt = total_invoiced - paid_amount.
     * Maps to Android's running "notpaid" calculation.
     * Uses bcmath for accounting precision.
     */
    public function getCurrentDebtAttribute(): string
    {
        return bcsub(
            (string) $this->total_invoiced,
            (string) $this->paid_amount,
            4
        );
    }

    /**
     * Whether this customer has exceeded their credit limit.
     */
    public function isOverCreditLimit(): bool
    {
        if (bccomp((string) $this->credit_limit, '0', 4) === 0) {
            return false; // 0 = no limit
        }

        return bccomp(
            $this->getCurrentDebtAttribute(),
            (string) $this->credit_limit,
            4
        ) > 0;
    }

    /**
     * Price tier label — mirrors Android getPriceTypeName().
     */
    public function getPriceTierLabelAttribute(): string
    {
        return match ($this->price_type) {
            2       => 'سعر بيع 2',
            3       => 'سعر بيع 3',
            default => 'سعر بيع 1',
        };
    }

    // ── Scopes ───────────────────────────────────────────────────
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForBranch($query, int $branchId)
    {
        return $query->where('branch_id', $branchId);
    }

    public function scopeSearch($query, string $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
              ->orWhere('phone', 'like', "%{$term}%");
        });
    }

    public function scopeWithDebt($query)
    {
        return $query->whereRaw('total_invoiced > paid_amount');
    }

    // ── Business Logic ───────────────────────────────────────────

    /**
     * Record a payment from this customer.
     * Increments paid_amount — call inside a DB transaction.
     */
    public function recordPayment(float $amount): void
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Payment amount must be positive.');
        }

        $this->paid_amount = bcadd(
            (string) $this->paid_amount,
            (string) $amount,
            4
        );
        $this->save();
    }

    /**
     * Add to total_invoiced when a new sale invoice is created.
     * Call inside a DB transaction.
     */
    public function addInvoiceTotal(float $amount): void
    {
        $this->total_invoiced = bcadd(
            (string) $this->total_invoiced,
            (string) $amount,
            4
        );
        $this->save();
    }
}
