<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Customer extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    /**
     * The attributes that are mass fillable.
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'opening_balance' => 'decimal:4',
        'current_balance' => 'decimal:4',
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
     * Recalculate the customer's current balance based on unpaid invoices.
     * 
     * Formula: opening_balance + sum(remaining from all sale invoices)
     */
    public function recalculateBalance(): void
    {
        $opening = (string) $this->opening_balance;
        
        // Sum remaining balance from all unpaid sale invoices
        // Note: SaleInvoice model will be part of Module 4
        $unpaidTotal = (string) $this->saleInvoices()
            ->where('remaining', '>', 0)
            ->sum('remaining');

        $newBalance = bcadd($opening, $unpaidTotal, 4);

        $this->update(['current_balance' => $newBalance]);
    }

    /**
     * Relations
     */

    public function saleInvoices(): HasMany
    {
        return $this->hasMany(SaleInvoice::class);
    }

    public function installments(): HasMany
    {
        return $this->hasMany(Installment::class);
    }

    public function branch(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function creator(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
