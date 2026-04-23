<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SaleInvoice extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    // Payment type constants — mirrors Android 'kind' field
    const PAYMENT_CASH    = 'cash';
    const PAYMENT_CREDIT  = 'credit';
    const PAYMENT_PARTIAL = 'partial';

    // Status constants
    const STATUS_PAID      = 'paid';
    const STATUS_PARTIAL   = 'partial';
    const STATUS_UNPAID    = 'unpaid';
    const STATUS_CANCELLED = 'cancelled';

    // Discount type constants — mirrors Android 'discount_kind'
    const DISCOUNT_FIXED   = 'fixed';
    const DISCOUNT_PERCENT = 'percent';

    protected $fillable = [
        'branch_id',
        'invoice_number',
        'invoice_date',
        'customer_id',
        'customer_name',
        'cashier_id',
        'cashier_name',
        'subtotal',
        'discount_amount',
        'discount_type',
        'total',
        'cost',
        'profit',
        'payment_type',
        'paid_amount',
        'remaining_amount',
        'previous_debt',
        'status',
        'notes',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'invoice_date'    => 'date',
        'subtotal'        => 'decimal:4',
        'discount_amount' => 'decimal:4',
        'total'           => 'decimal:4',
        'cost'            => 'decimal:4',
        'profit'          => 'decimal:4',
        'paid_amount'     => 'decimal:4',
        'remaining_amount' => 'decimal:4',
        'previous_debt'   => 'decimal:4',
    ];

    // ── Activity Log ─────────────────────────────────────────────
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status', 'paid_amount', 'remaining_amount'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $e) => "SaleInvoice {$e}");
    }

    // ── Relations ────────────────────────────────────────────────
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function cashier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(SaleInvoiceItem::class);
    }

    public function installments(): HasMany
    {
        return $this->hasMany(Installment::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // ── Scopes ───────────────────────────────────────────────────
    public function scopeForBranch($query, int $branchId)
    {
        return $query->where('branch_id', $branchId);
    }

    public function scopeUnpaid($query)
    {
        return $query->whereIn('status', [self::STATUS_UNPAID, self::STATUS_PARTIAL]);
    }

    public function scopeForCustomer($query, int $customerId)
    {
        return $query->where('customer_id', $customerId);
    }

    public function scopeDateBetween($query, string $from, string $to)
    {
        return $query->whereBetween('invoice_date', [$from, $to]);
    }

    // ── Accessors ─────────────────────────────────────────────────
    public function getIsPaidAttribute(): bool
    {
        return $this->status === self::STATUS_PAID;
    }

    public function getIsCancelledAttribute(): bool
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    // ── Helpers ───────────────────────────────────────────────────

    /**
     * Generate next sequential invoice number for a branch.
     * Format: INV-{YEAR}-{5-digit sequence}
     */
    public static function generateInvoiceNumber(int $branchId): string
    {
        $year  = now()->year;
        $count = static::where('branch_id', $branchId)
                        ->whereYear('invoice_date', $year)
                        ->withTrashed()
                        ->count();

        return sprintf('INV-%d-%05d', $year, $count + 1);
    }

    /**
     * Record a partial/full payment against this invoice.
     * Must be called inside a DB::transaction().
     */
    public function recordPayment(float $amount): void
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Payment amount must be positive.');
        }

        $newPaid = bcadd((string) $this->paid_amount, (string) $amount, 4);
        $newRemaining = bcsub((string) $this->total, $newPaid, 4);

        // Clamp remaining to zero — overpayments go to customer credit
        if (bccomp($newRemaining, '0', 4) < 0) {
            $newRemaining = '0.0000';
        }

        $this->paid_amount     = $newPaid;
        $this->remaining_amount = $newRemaining;
        $this->status = bccomp($newRemaining, '0', 4) <= 0
            ? self::STATUS_PAID
            : self::STATUS_PARTIAL;

        $this->save();
    }
}
