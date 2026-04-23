<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Product extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'branch_id',
        'category_id',
        'code_id',
        'barcode2',
        'barcode3',
        'name',
        'description',
        'expire_date',
        // Unit tier 1
        'unit_id',
        'buy_price',
        'sell_price',
        // Unit tier 2
        'unit2_name',
        'factor2',
        'buy_price2',
        'sell_price2',
        'sell_price_unit2',
        // Unit tier 3
        'unit3_name',
        'factor3',
        'buy_price3',
        'sell_price3',
        'sell_price_unit3',
        // Stock
        'quantity',
        'min_quantity',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'buy_price'          => 'decimal:4',
        'sell_price'         => 'decimal:4',
        'buy_price2'         => 'decimal:4',
        'sell_price2'        => 'decimal:4',
        'sell_price_unit2'   => 'decimal:4',
        'buy_price3'         => 'decimal:4',
        'sell_price3'        => 'decimal:4',
        'sell_price_unit3'   => 'decimal:4',
        'factor2'            => 'decimal:4',
        'factor3'            => 'decimal:4',
        'quantity'           => 'decimal:4',
        'min_quantity'       => 'decimal:4',
        'expire_date'        => 'date',
        'is_active'          => 'boolean',
    ];

    // ── Activity Log ─────────────────────────────────────────────
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $e) => "Product {$e}");
    }

    // ── Relations ────────────────────────────────────────────────
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(UnitOfMeasure::class, 'unit_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Polymorphic attachments (replaces Android IMAGE blob).
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    // ── Scopes ───────────────────────────────────────────────────
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForBranch($query, int $branchId)
    {
        return $query->where('branch_id', $branchId);
    }

    public function scopeLowStock($query)
    {
        return $query->whereColumn('quantity', '<=', 'min_quantity')
                     ->where('min_quantity', '>', 0);
    }

    public function scopeSearch($query, string $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
              ->orWhere('code_id', 'like', "%{$term}%")
              ->orWhere('barcode2', 'like', "%{$term}%")
              ->orWhere('barcode3', 'like', "%{$term}%");
        });
    }

    // ── Business Logic Helpers ───────────────────────────────────

    /**
     * Resolve sell price by unit tier (1, 2, or 3).
     * Mirrors Android's price selection logic.
     */
    public function getSellPriceForTier(int $tier = 1): string
    {
        return match ($tier) {
            2 => $this->sell_price2 ?? $this->sell_price,
            3 => $this->sell_price3 ?? $this->sell_price,
            default => $this->sell_price,
        };
    }

    /**
     * Reduce stock quantity. Always use this — never update quantity directly.
     * Throws if stock would go negative.
     */
    public function decrementStock(float $qty): void
    {
        if (bccomp((string) $this->quantity, (string) $qty, 4) < 0) {
            throw new \RuntimeException(
                "Insufficient stock for product [{$this->code_id}]. " .
                "Available: {$this->quantity}, Requested: {$qty}"
            );
        }

        $this->decrement('quantity', $qty);
    }

    /**
     * Increase stock quantity (on purchase or return).
     */
    public function incrementStock(float $qty): void
    {
        $this->increment('quantity', $qty);
    }

    /**
     * Check if product is below minimum stock threshold.
     */
    public function isLowStock(): bool
    {
        return $this->min_quantity > 0
            && bccomp((string) $this->quantity, (string) $this->min_quantity, 4) <= 0;
    }
}
