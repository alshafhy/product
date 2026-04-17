<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Installment extends AppBaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sale_invoice_id',
        'customer_id',
        'amount',
        'due_date',
        'paid_date',
        'status',
        'payment_type',
        'guarantor_name',
        'guarantor_phone',
        'days_limit',
        'description',
        'created_by',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'amount' => 'float',
            'due_date' => 'date',
            'paid_date' => 'date',
            'days_limit' => 'integer',
            'sale_invoice_id' => 'integer',
            'customer_id' => 'integer',
            'created_by' => 'integer',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Scope a query to only include overdue installments.
     */
    public function scopeOverdue(Builder $query): Builder
    {
        return $query->where('due_date', '<', Carbon::today())
                     ->where('status', 'not_paid');
    }

    /**
     * Scope a query to only include installments due this week.
     */
    public function scopeDueThisWeek(Builder $query): Builder
    {
        return $query->whereBetween('due_date', [
            Carbon::today(),
            Carbon::today()->addDays(7)
        ]);
    }

    /**
     * Get the sale invoice associated with the installment.
     */
    public function saleInvoice(): BelongsTo
    {
        return $this->belongsTo(SaleInvoice::class);
    }

    /**
     * Get the customer associated with the installment.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the user who created the installment.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
