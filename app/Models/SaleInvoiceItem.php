<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleInvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_invoice_id',
        'product_id',
        'product_code',
        'product_name',
        'price_type',
        'unit_name',
        'unit_factor',
        'quantity',
        'sell_price',
        'buy_price',
        'line_total',
    ];

    protected $casts = [
        'unit_factor' => 'decimal:4',
        'quantity'    => 'decimal:4',
        'sell_price'  => 'decimal:4',
        'buy_price'   => 'decimal:4',
        'line_total'  => 'decimal:4',
    ];

    // ── Relations ────────────────────────────────────────────────
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(SaleInvoice::class, 'sale_invoice_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // ── Accessor ──────────────────────────────────────────────────
    /**
     * Line profit = (sell_price - buy_price) * quantity
     */
    public function getLineProfitAttribute(): string
    {
        $margin = bcsub((string) $this->sell_price, (string) $this->buy_price, 4);
        return bcmul($margin, (string) $this->quantity, 4);
    }
}
