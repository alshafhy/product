<?php

namespace App\Models;

use App\Models\AppBaseModel;
use App\Models\LandLayer;


use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class ReturnSituation
 * @package App\Models
 * @version March 25, 2022, 6:23 pm UTC
 *
 * @property integer $work_order_number
 * @property integer $work_type_id
 */
class ReturnSituation extends AppBaseModel
{
    use LogsActivity;
    use SoftDeletes;


    public $table = 'work_orders';
    

   




    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('ReturnSituation')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->logAll();
    }

    public $fillable = [
        'work_order_number',
        'work_type_id',
        'district_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'work_order_number' => 'integer',
        'work_type_id' => 'integer',
        'deleted_at'   =>'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];


    public function landLayers()
    {
        return $this->hasMany(LandLayer::class , 'work_order_id' , 'id' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function workType()
    {
        return $this->belongsTo(\App\Models\WorkType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function workOrdersType()
    {
        return $this->belongsTo(\App\Models\WorkOrdersType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function branch()
    {
        return $this->belongsTo(\App\Models\Branch::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function city()
    {
        return $this->belongsTo(\App\Models\City::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function district()
    {
        return $this->belongsTo(\App\Models\District::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function currentDepartment()
    {
        return $this->belongsTo(\App\Models\Department::class, 'current_department_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function electricalStationsType()
    {
        return $this->belongsTo(\App\Models\ElectricalStationsType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function workOrdersStage()
    {
        return $this->belongsTo(\App\Models\WorkOrdersStage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function electricityDepartment()
    {
        return $this->belongsTo(\App\Models\ElectricityDepartment::class);
    }

    public function workOrdersPermits()
    {
        return $this->belongsToMany(WorkOrdersPermit::class);
    }

    public function activities(){
        return $this->hasMany(Activity::class,'subject_id','id')->where(['subject_type'=>'App\Models\ReturnSituation']);
    }
}
