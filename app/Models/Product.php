<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends AppBaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code_id',
        'name',
        'description',
        'category_id',
        'sell_price',
        'sell_price2',
        'sell_price3',
        'buy_price',
        'buy_price2',
        'buy_price3',
        'quantity',
        'expire_date',
        'unit1',
        'unit2',
        'unit3',
        'factor2',
        'factor3',
        'sell_price_unit2',
        'sell_price_unit3',
        'barcode2',
        'barcode3',
        'branch_id',
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
            'sell_price' => 'float',
            'sell_price2' => 'float',
            'sell_price3' => 'float',
            'buy_price' => 'float',
            'buy_price2' => 'float',
            'buy_price3' => 'float',
            'quantity' => 'float',
            'factor2' => 'float',
            'factor3' => 'float',
            'sell_price_unit2' => 'float',
            'sell_price_unit3' => 'float',
            'expire_date' => 'date',
            'category_id' => 'integer',
            'branch_id' => 'integer',
            'created_by' => 'integer',
            'updated_by' => 'integer',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Scope a query to only include products with stock less than or equal to a threshold.
     */
    public function scopeLowStock(Builder $query, float $threshold = 5): Builder
    {
        return $query->where('quantity', '<=', $threshold);
    }

    /**
     * Get the sell price for a specific unit.
     */
    public function getEffectiveSellPrice(?string $unit): float
    {
        if (!$unit) {
            return (float) $this->sell_price;
        }

        if ($unit === $this->unit1) {
            return (float) $this->sell_price;
        }

        if ($unit === $this->unit2) {
            return (float) $this->sell_price_unit2;
        }

        if ($unit === $this->unit3) {
            return (float) $this->sell_price_unit3;
        }

        return (float) $this->sell_price;
    }

    /**
     * Get the category that the product belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the branch that the product belongs to.
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the user who created the product.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated the product.
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the images for the product.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }
}
