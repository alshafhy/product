<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Supplier extends Model
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
     * Recalculate the supplier's current balance based on unpaid purchase invoices.
     */
    public function recalculateBalance(): void
    {
        $opening = (string) $this->opening_balance;
        
        $unpaidTotal = (string) $this->purchaseInvoices()
            ->where('remaining', '>', 0)
            ->sum('remaining');

        $newBalance = bcadd($opening, $unpaidTotal, 4);

        $this->update(['current_balance' => $newBalance]);
    }

    /**
     * Relations
     */

    public function purchaseInvoices(): HasMany
    {
        return $this->hasMany(PurchaseInvoice::class);
    }

    public function branch(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}
