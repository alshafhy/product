<?php

namespace App\Models;

class Branch extends AppBaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'city_id',
        'district_id',
        'is_main_branch',
    ];
}
