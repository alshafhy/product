<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShopSetting extends AppBaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'branch_id',
        'shop_name',
        'phone',
        'logo_path',
        'currency',
        'print_settings',
        'invoice_settings',
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
            'branch_id' => 'integer',
            'print_settings' => 'array',
            'invoice_settings' => 'array',
        ];
    }

    /**
     * Get the branch associated with the shop settings.
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}
