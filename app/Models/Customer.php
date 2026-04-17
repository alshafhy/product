<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends AppBaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'address',
        'opening_balance',
        'current_balance',
        'notes',
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
            'opening_balance' => 'float',
            'current_balance' => 'float',
            'branch_id' => 'integer',
            'created_by' => 'integer',
            'updated_by' => 'integer',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Recalculate the customer balance based on opening balance and unpaid invoices.
     */
    public function recalculateBalance(): void
    {
        // Sum all unpaid invoice remainders. 
        // Assuming SaleInvoice has a 'remainder' column.
        $unpaidAmount = $this->saleInvoices()->sum('remainder') ?? 0;
        
        $this->current_balance = $this->opening_balance + $unpaidAmount;
        $this->save();
    }

    /**
     * Get the sale invoices for the customer.
     */
    public function saleInvoices(): HasMany
    {
        return $this->hasMany(SaleInvoice::class);
    }

    /**
     * Get the installments for the customer.
     */
    public function installments(): HasMany
    {
        return $this->hasMany(Installment::class);
    }

    /**
     * Get the branch the customer belongs to.
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the user who created the customer.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated the customer.
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
