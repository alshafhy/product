<?php

namespace App\Models;

use App\Traits\Branchable;
use Illuminate\Support\Str;
use App\Models\AppBaseModel;
use App\Traits\CreatedUpdatedBy;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attachment extends AppBaseModel
{
    use HasFactory, SoftDeletes, LogsActivity ,Branchable , CreatedUpdatedBy;

    protected $fillable = [
        'uuid',
        'model_type',
        'model_id',
        'path',
        'name',
        'filename',
        'type',
        'extension',
        'size',
        'attachment_type_id',
        'title',
        'description',
        'metadata',
        'created_by',
        'updated_by',
        'driver_type',
    ];

    protected $casts = [
        'metadata'=>'array'
    ];
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'title' => 'required'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Attachment')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->logAll();
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
            if(empty($model->created_by)) {
                $model->created_by = auth()->id() ?? null;
                $model->updated_by = auth()->id() ?? null;
            }
        });
        static::updating(function ($model) {
            if(empty($model->updated_by)) {
                $model->updated_by = auth()->id() ?? null;
            }
        });
    }

    public function activities(){
        return $this->hasMany(Activity::class,'subject_id','id')->where(['subject_type'=>'App\Models\Attachment']);
    }

    public function attachmentType(){
        return $this->hasOne(AttachmentType::class,'id','attachment_type_id');
    }

    public function creator(){
        return $this->hasOne(User::class,'id','created_by')->withDefault(['name'=>'-']);
    }
}
