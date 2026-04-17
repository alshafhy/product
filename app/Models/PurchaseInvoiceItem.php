<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseInvoiceItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass fillable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'purchase_invoice_id',
        'product_id',
        'product_name',
        'code_id',
        'quantity',
        'unit_name',
        'buy_price',
        'suggested_sell_price',
        'line_total',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'decimal:4',
        'buy_price' => 'decimal:4',
        'suggested_sell_price' => 'decimal:4',
        'line_total' => 'decimal:4',
    ];

    /**
     * Relations
     */

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(PurchaseInvoice::class, 'purchase_invoice_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
