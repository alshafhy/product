<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, LogsActivity, HasRoles ;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'branch_id',
        'last_login_at',
        'last_login_ip_address',
        'access_token',
        'pass_need_to_be_changed'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'username' => 'required|unique:users',
        'email' => 'required|email|unique:users'
    ];

    public static $rulesForUpdate =  [
        'name' => 'required',
        'username' => 'required',
        'email' => 'required|email'
    ];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('User')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->logOnly(['name', 'username', 'email']);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];



    public function activities(){
        return $this->hasMany(Activity::class,'subject_id','id')->where(['subject_type'=>'App\Models\User']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function branch()
    {
        return $this->belongsTo(\App\Models\Branch::class);
    }
}
