<?php // Code within app\Helpers\UserPermissions.php

namespace App\Helpers;

use Config;
use Carbon\Carbon;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Notifications\GeneralNotification;
use Illuminate\Support\Facades\Notification;

class UserPermissions
{
    public static $systemName ;
    
    public static function hasAccessTo($permissionName)
    {
        $user=Auth::user();
        if ($user != null) {
            if ($user->hasRole('admin') || $user->can($permissionName) ) {
                return true;
            }
        }
        return false;
    }

    public static function hasAccessToAction($actionName)
    {
        $user=Auth::user();
        if ($user != null) {
            if ($user->hasRole('admin') || $user->can(self::getPermissionName($actionName)) ) {
                return true;
            }
        }
        return false;
    }
    


    /**
     * get permissionName string from route prefix & name
     *
     * @return @var permissionName
     */
    public static function getPermissionName($actionName = "")
    {
        if($actionName){
            $permissionName = self::getCurrentRouteName( true , true).".".$actionName;
        }else{
            $permissionName = self::getCurrentRouteName( true);
        }
        return $permissionName;
    }

     /**
     * get Current Route Name from the Route 
     *
     * @param [bool] $permissiowithPrefixnName
     * @return @var routeName
     */
    public static function getCurrentRouteName( $withPrefix = false ,$removeMethodName = false)
    {
        $prefixName = str_replace('/', '', Route::current()->getPrefix());
        $routeName = Route::current()->getName();
        if($removeMethodName){
            $arr = explode(".", $routeName);
            $routeName = $arr[0];
        }
        
        if($prefixName && $withPrefix  ){
            $routeName = $prefixName ."." .$routeName;
        }
        
        return $routeName;
    }

    public static function getPrefixName()  {
        return str_replace('/', '', Route::current()->getPrefix());
    }

    public static function getCurrentMethodName()
    {
        $routeName = Route::current()->getName();
        $arr = explode(".", $routeName);
        $methodName = $arr[1];
        return $methodName;
    }

    /**
     * get Route Name from the generated permisionName
     *
     * @param [string] $permissionName
     * @return @var routeName
     */
    private function getRouteName($permissionName)
    {
        $arr = explode("-", $permissionName);
        $routeName = $arr[0];
        return $routeName;
    }
    

    /**
     * Get the value of systemName
     */
    public function getSystemName()
    {
        return self::$systemName;
    }

    /**
     * Set the value of systemName
     *
     * @return  self
     */
    public function setSystemName($systemName)
    {
        self::$systemName = $systemName;

        return $this;
    }

}