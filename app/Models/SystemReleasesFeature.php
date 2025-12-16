<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
class SystemReleasesFeature extends Model
{
     use SoftDeletes;    public $table = 'system_releases_features';

    public $fillable = [
        'system_release_id',
        'title',
        'description',
        'feature_order'
    ];

    protected $casts = [
        'system_release_id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'feature_order' => 'integer'
    ];

    public static array $rules = [
        'system_release_id' => 'required'
    ];

    public function release()
    {
        return $this->belongsTo(SystemRelease::class);
    }
}
