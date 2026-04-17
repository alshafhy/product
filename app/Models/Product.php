<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    /**
     * The attributes that are mass fillable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code_id',
        'name',
        'description',
        'category_id',
        'sell_price',
        'buy_price',
        'sell_price2',
        'buy_price2',
        'sell_price3',
        'buy_price3',
        'quantity',
        'unit1',
        'unit2',
        'unit3',
        'factor2',
        'factor3',
        'sell_price_unit2',
        'sell_price_unit3',
        'barcode2',
        'barcode3',
        'expire_date',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'sell_price' => 'decimal:4',
        'buy_price' => 'decimal:4',
        'sell_price2' => 'decimal:4',
        'buy_price2' => 'decimal:4',
        'sell_price3' => 'decimal:4',
        'buy_price3' => 'decimal:4',
        'quantity' => 'decimal:4',
        'factor2' => 'decimal:4',
        'factor3' => 'decimal:4',
        'sell_price_unit2' => 'decimal:4',
        'sell_price_unit3' => 'decimal:4',
        'expire_date' => 'date',
    ];

    /**
     * Configuration for activity logging.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty();
    }

    /**
     * Get the effective sell price using BCMath.
     * 
     * @param string $priceType The column name (e.g. 'sell_price', 'sell_price2')
     * @return string
     */
    public function getEffectiveSellPrice(string $priceType): string
    {
        $price = (string) ($this->{$priceType} ?? '0');
        // Ensure it's a valid bcmath string (normalized)
        return bcadd('0', $price, 4);
    }

    /**
     * Scope for low stock identification.
     */
    public function scopeLowStock($query, $threshold = 5)
    {
        return $query->where('quantity', '<=', $threshold);
    }

    /**
     * Relations
     */

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
