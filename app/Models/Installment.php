<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Installment extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    const STATUS_NOT_PAID = 'not_paid';
    const STATUS_PAID     = 'paid';

    protected $fillable = [
        'sale_invoice_id',
        'customer_id',
        'client_name',
        'description',
        'days_limit',
        'collect_date',
        'amount',
        'status',
        'pay_type',
        'paid_date',
        'guarantor_name',
        'guarantor_phone',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'amount'       => 'decimal:4',
        'collect_date' => 'date',
        'paid_date'    => 'date',
        'days_limit'   => 'integer',
    ];

    // ── Activity Log ─────────────────────────────────────────────
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status', 'paid_date', 'pay_type'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $e) => "Installment {$e}");
    }

    // ── Relations ────────────────────────────────────────────────
    public function saleInvoice(): BelongsTo
    {
        return $this->belongsTo(SaleInvoice::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // ── Scopes ───────────────────────────────────────────────────
    public function scopeUnpaid($query)
    {
        return $query->where('status', self::STATUS_NOT_PAID);
    }

    public function scopePaid($query)
    {
        return $query->where('status', self::STATUS_PAID);
    }

    /**
     * Overdue = status not_paid AND collect_date < today.
     * Maps Android: statue.equals("not_paid") && today.after(collectdate)
     */
    public function scopeOverdue($query)
    {
        return $query->where('status', self::STATUS_NOT_PAID)
                     ->where('collect_date', '<', today());
    }

    public function scopeForCustomer($query, int $customerId)
    {
        return $query->where('customer_id', $customerId);
    }

    public function scopeDueBetween($query, string $from, string $to)
    {
        return $query->whereBetween('collect_date', [$from, $to]);
    }

    public function scopeForBranch($query, int $branchId)
    {
        return $query->whereHas('saleInvoice', fn($q) => $q->where('branch_id', $branchId));
    }

    // ── Accessors ─────────────────────────────────────────────────

    /**
     * Maps Android: TimeUnit.DAYS.convert(today - collectdate)
     * Returns number of days overdue (0 if not overdue).
     */
    public function getDaysOverdueAttribute(): int
    {
        if ($this->status === self::STATUS_PAID) {
            return 0;
        }

        $diff = today()->diffInDays($this->collect_date, false);

        // diffInDays returns negative when collect_date is in the past
        return $diff < 0 ? abs((int) $diff) : 0;
    }

    public function getIsOverdueAttribute(): bool
    {
        return $this->status === self::STATUS_NOT_PAID
            && $this->collect_date->isPast();
    }

    public function getIsPaidAttribute(): bool
    {
        return $this->status === self::STATUS_PAID;
    }

    public function getStatusArabicAttribute(): string
    {
        return $this->status === self::STATUS_PAID ? 'مدفوع' : 'غير مدفوع';
    }
}
