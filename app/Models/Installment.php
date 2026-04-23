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
        'guarantor_name',
        'guarantor_phone',
        'paid_date',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'days_limit'   => 'integer',
        'collect_date' => 'date',
        'amount'       => 'decimal:4',
        'paid_date'    => 'date',
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

    // ── Scopes ───────────────────────────────────────────────────
    public function scopeUnpaid($query)
    {
        return $query->where('status', self::STATUS_NOT_PAID);
    }

    public function scopeOverdue($query)
    {
        return $query->unpaid()->where('collect_date', '<', now()->toDateString());
    }

    public function scopeForCustomer($query, int $customerId)
    {
        return $query->where('customer_id', $customerId);
    }

    public function scopeDueBetween($query, string $from, string $to)
    {
        return $query->whereBetween('collect_date', [$from, $to]);
    }

    // ── Accessors ────────────────────────────────────────────────
    /**
     * Is this installment past its due date and still unpaid?
     */
    public function getIsOverdueAttribute(): bool
    {
        return $this->status === self::STATUS_NOT_PAID 
            && $this->collect_date->isPast() 
            && !$this->collect_date->isToday();
    }

    /**
     * Number of days overdue.
     */
    public function getDaysOverdueAttribute(): int
    {
        if (!$this->is_overdue) {
            return 0;
        }

        return (int) $this->collect_date->diffInDays(now());
    }
}
