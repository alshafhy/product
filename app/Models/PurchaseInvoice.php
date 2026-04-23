<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PurchaseInvoice extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    const PAYMENT_CASH    = 'cash';
    const PAYMENT_CREDIT  = 'credit';
    const PAYMENT_PARTIAL = 'partial';

    const STATUS_PAID      = 'paid';
    const STATUS_PARTIAL   = 'partial';
    const STATUS_UNPAID    = 'unpaid';
    const STATUS_CANCELLED = 'cancelled';

    const DISCOUNT_FIXED   = 'fixed';
    const DISCOUNT_PERCENT = 'percent';

    protected $fillable = [
        'branch_id',
        'invoice_number',
        'invoice_date',
        'supplier_id',
        'supplier_name',
        'cashier_id',
        'cashier_name',
        'subtotal',
        'discount_amount',
        'discount_type',
        'total',
        'payment_type',
        'paid_amount',
        'remaining_amount',
        'status',
        'notes',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'invoice_date'     => 'date',
        'subtotal'         => 'decimal:4',
        'discount_amount'  => 'decimal:4',
        'total'            => 'decimal:4',
        'paid_amount'      => 'decimal:4',
        'remaining_amount' => 'decimal:4',
    ];

    // ── Activity Log ─────────────────────────────────────────────
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status', 'paid_amount', 'remaining_amount'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $e) => "PurchaseInvoice {$e}");
    }

    // ── Relations ────────────────────────────────────────────────
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function cashier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(PurchaseInvoiceItem::class);
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

    public function scopeForSupplier($query, int $supplierId)
    {
        return $query->where('supplier_id', $supplierId);
    }

    public function scopeDateBetween($query, string $from, string $to)
    {
        return $query->whereBetween('invoice_date', [$from, $to]);
    }

    // ── Helpers ───────────────────────────────────────────────────

    /**
     * Generate next sequential purchase invoice number.
     * Format: PUR-{YEAR}-{5-digit sequence}
     */
    public static function generateInvoiceNumber(int $branchId): string
    {
        $year  = now()->year;
        $count = static::where('branch_id', $branchId)
                        ->whereYear('invoice_date', $year)
                        ->withTrashed()
                        ->count();

        return sprintf('PUR-%d-%05d', $year, $count + 1);
    }

    /**
     * Record a payment made to supplier against this invoice.
     * Must be called inside a DB::transaction().
     */
    public function recordPayment(float $amount): void
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Payment amount must be positive.');
        }

        $newPaid      = bcadd((string) $this->paid_amount, (string) $amount, 4);
        $newRemaining = bcsub((string) $this->total, $newPaid, 4);

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
