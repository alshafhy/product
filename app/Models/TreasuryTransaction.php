<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TreasuryTransaction extends AppBaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'branch_id',
        'user_id',
        'type',
        'amount',
        'reference_type',
        'reference_id',
        'description',
        'transacted_at',
        'created_by',
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
            'amount' => 'float',
            'transacted_at' => 'datetime',
            'branch_id' => 'integer',
            'user_id' => 'integer',
            'created_by' => 'integer',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Get the parent referenceable model (SaleInvoice, PurchaseInvoice, etc.).
     */
    public function reference(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the branch associated with the transaction.
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the user associated with the transaction.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user who created the transaction.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
