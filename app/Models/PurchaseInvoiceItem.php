<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseInvoiceItem extends AppBaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'purchase_invoice_id',
        'product_id',
        'product_name',
        'code_id',
        'quantity',
        'unit_factor',
        'unit_name',
        'price_type',
        'buy_price',
        'sell_price',
        'line_total',
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
            'purchase_invoice_id' => 'integer',
            'product_id' => 'integer',
            'quantity' => 'float',
            'unit_factor' => 'float',
            'buy_price' => 'float',
            'sell_price' => 'float',
            'line_total' => 'float',
        ];
    }

    /**
     * Get the invoice that the item belongs to.
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(PurchaseInvoice::class, 'purchase_invoice_id');
    }

    /**
     * Get the product associated with the item.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
