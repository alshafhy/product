<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AppBaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class AttachmentType extends AppBaseModel
{
    use HasFactory, SoftDeletes, LogsActivity;
    public $table = 'attachment_types';
    

   



    public $fillable = [
        'title',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'deleted_at'   =>'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('AttachmentType')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->logAll();
    }

    public function activities(){
        return $this->hasMany(Activity::class,'subject_id','id')->where(['subject_type'=>'App\Models\AttachmentType']);
    }

    public function attachment(){
        return $this->hasMany(Attachment::class,'attachment_type_id','id');
    }
}
