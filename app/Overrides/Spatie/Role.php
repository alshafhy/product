<?php

namespace App\Overrides\Spatie;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $guarded = [];

   

    public $fillable = [
        'name',
        'ar_name',
        'guard_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'ar_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

}
