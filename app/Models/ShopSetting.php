<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShopSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'shop_name',
        'shop_ar_name',
        'phone',
        'address',
        'logo_path',
        'currency',
        'currency_symbol',
        'decimal_places',
        'print_settings',
        'invoice_settings',
        'updated_by',
    ];

    protected $casts = [
        'print_settings'  => 'array',
        'invoice_settings' => 'array',
        'decimal_places'  => 'integer',
    ];

    // ── Relations ────────────────────────────────────────────────
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // ── Helpers ──────────────────────────────────────────────────

    /**
     * Get shop settings for a branch, or fall back to first record.
     */
    public static function forBranch(int $branchId): ?self
    {
        return static::where('branch_id', $branchId)->first()
            ?? static::first();
    }
}
