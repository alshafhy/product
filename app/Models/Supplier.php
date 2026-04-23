<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Supplier extends Model
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
        'balance_adjustment',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'paid_amount'          => 'decimal:4',
        'total_invoiced'       => 'decimal:4',
        'balance_adjustment'   => 'decimal:4',
        'is_active'            => 'boolean',
    ];

    // ── Activity Log ─────────────────────────────────────────────
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $e) => "Supplier {$e}");
    }

    // ── Relations ────────────────────────────────────────────────
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function purchaseInvoices(): HasMany
    {
        return $this->hasMany(PurchaseInvoice::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // ── Accessors ─────────────────────────────────────────────────

    /**
     * Net balance owed to supplier.
     * = total_invoiced - paid_amount + balance_adjustment
     */
    public function getNetBalanceAttribute(): string
    {
        $base = bcsub(
            (string) $this->total_invoiced,
            (string) $this->paid_amount,
            4
        );

        return bcadd($base, (string) $this->balance_adjustment, 4);
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

    // ── Business Logic ───────────────────────────────────────────

    /**
     * Record a payment made TO this supplier.
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
     * Add a purchase invoice total to supplier's account.
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

    /**
     * Apply manual balance correction (maps to remove_supplier_error dialog).
     */
    public function applyBalanceAdjustment(float $amount): void
    {
        $this->balance_adjustment = bcadd(
            (string) $this->balance_adjustment,
            (string) $amount,
            4
        );
        $this->save();
    }
}
