<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleInvoice extends AppBaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'invoice_number',
        'customer_id',
        'user_id',
        'branch_id',
        'subtotal',
        'discount',
        'discount_type',
        'total',
        'cost',
        'profit',
        'paid',
        'remaining',
        'previous_debt',
        'total_debt',
        'payment_type',
        'status',
        'notes',
        'invoiced_at',
        'created_by',
        'updated_by',
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
            'subtotal' => 'float',
            'discount' => 'float',
            'total' => 'float',
            'cost' => 'float',
            'profit' => 'float',
            'paid' => 'float',
            'remaining' => 'float',
            'previous_debt' => 'float',
            'total_debt' => 'float',
            'invoiced_at' => 'datetime',
            'customer_id' => 'integer',
            'user_id' => 'integer',
            'branch_id' => 'integer',
            'created_by' => 'integer',
            'updated_by' => 'integer',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Get the customer associated with the invoice.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the user who issued the invoice.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the branch where the invoice was issued.
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the items for the sale invoice.
     */
    public function items(): HasMany
    {
        return $this->hasMany(SaleInvoiceItem::class);
    }

    /**
     * Get the user who created the record.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated the record.
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
