<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseInvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_invoice_id',
        'product_id',
        'product_code',
        'product_name',
        'unit_name',
        'unit_factor',
        'quantity',
        'buy_price',
        'sell_price',
        'line_total',
    ];

    protected $casts = [
        'unit_factor' => 'decimal:4',
        'quantity'    => 'decimal:4',
        'buy_price'   => 'decimal:4',
        'sell_price'  => 'decimal:4',
        'line_total'  => 'decimal:4',
    ];

    // ── Relations ────────────────────────────────────────────────
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(PurchaseInvoice::class, 'purchase_invoice_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
