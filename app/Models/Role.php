<?php

namespace App\Models;

use App\Models\AppBaseModel;



/**
 * Class Role
 * @package App\Models
 * @version January 1, 2022, 10:52 am UTC
 *
 * @property string $name
 * @property string $ar_name
 */
class Role extends AppBaseModel
{


    public $table = 'roles';
    



    public $fillable = [
        'name',
        'ar_name'
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
