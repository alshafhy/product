<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
class SystemRelease extends Model
{
     use SoftDeletes;    public $table = 'system_releases';

    public $fillable = [
        'version_number',
        'release_date'
    ];

    protected $casts = [
        'version_number' => 'string',
        'release_date' => 'date'
    ];

    public static array $rules = [
        'version_number' => 'required',
        'release_date' => 'required'
    ];

    function features()  {
        return $this->hasMany(\App\Models\SystemReleasesFeature::class, 'system_release_id' , 'id');
    }
}
