<?php

namespace App\Utils;

use App\Models\SystemComponent;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Overrides\Spatie\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;


class PermissionsUtil
{
    private $nodeObject ; 
    private $defaultMethods =array('index','create','edit','show','delete'/*,'update','store','destroy'*/);
    private static $permissionNameUseNodeId=false;
    private static $permissionNameSeparator=".";

    public static function clearPermissionCash()
    {
        return Artisan::call("cache:forget", ['key' => 'spatie.permission.cache']);
    }


    // public static function getObjectsByParent($objectId)
    // {
    //     /** TODO: refact the query to elquent */
    //     $sql = "select *
    //                 from prm_objects b 
    //                 where b.object_type = 3 
    //                 and exists (select null 
    //                                 from prm_objects a
    //                                 where a.id = b.parent_object_id 
    //                                 and a.parent_object_id = $objectId )";
    //     return DB::select($sql);
    // }


    public static function assignAllPermissionsToDevRole()
    {
        $role = Role::find(3);    
        $objectsPermIds = Permission::get()->pluck('id');
        $role->syncPermissions($objectsPermIds);

        static::clearPermissionCash();
    }


    public function addPermissionsToObject($nodeId)
    {
        $node = SystemComponent::find($nodeId);
        $this->setNodeObject($node) ; 

        $actions = collect($this->defaultMethods);
        $actions->map(function($item, $key) {
            return static::generatePermToAction($this->getNodeObject() , $item);
        })
        ->map(function($item, $key) {
            $input = [
                'name' => $item,
                'guard_name' => 'web',
                'system_component_id' => ($this->getNodeObject())->id
              ]; 
            // Permission::create($input);
            Permission::updateOrCreate(
                ['name' => $item],
                $input
            );
        });

        static::clearPermissionCash();
    }

    public static function addPermissionNameToObject($nodeId, $actionName)
    {
        $node = SystemComponent::find($nodeId);
        
        $generatedPermissionName = static::generatePermToAction($node, $actionName);

        $input = [
            'name' => $generatedPermissionName,
            'guard_name' => 'web',
            'system_component_id' => $node->id
            ]; 
        $Permission= Permission::create($input);

        static::clearPermissionCash();
        if($Permission){
            return $Permission;
        }
        return false;
    }


    public static function generatePermToAction($node,$actionName){
        //$sysName = SystemComponent::GetSystemName($node->id);
        $permissionNameSeparator = self::$permissionNameSeparator;
        if($node->comp_type == 4){
            $permissionName=  "reports.".$node->route_name;
        }else{
            $permissionName=  $node->route_name.$permissionNameSeparator.$actionName;
            if($node->prefix){
                $permissionName=Str::lower($node->prefix).$permissionNameSeparator.$permissionName;
            }
        }
        
        if(self::$permissionNameUseNodeId){
            $permissionName .=  $permissionNameSeparator.$node->id;
        }
        return $permissionName;
    }
    

    public static function encrypt_base64_simple($string) {
        $string = base64_encode($string);
        $encreption = base64_encode($string);
        return $encreption;
    }


    public static function decrypt_base64_simple($string) {
        $string_decode = base64_decode($string);
        $encreption = base64_decode($string_decode);
        return $encreption;
    }


    // public function addObjectPermDev($objectId){
    //     $this->addPermissionsToObject($objectId);
    //     static::assignAllPermissionsToDevRole();
    // }


    // public function addPermToObjectToDevRole($objectId,$mode='test'){
    //     $this->addPermissionsToObject($objectId);
    //     static::assignAllPermissionsToDevRole();
    // }


    public static function generatePermLabel($permissionName)
    {
        if (Str::contains($permissionName, 'index')) {
            $permLabel = 'قائمة';
        } elseif (Str::contains($permissionName, 'create')) {
            $permLabel = 'إضافة';
        } elseif (Str::contains($permissionName, 'edit')) {
            $permLabel = 'تعديل';
        } elseif (Str::contains($permissionName, 'show')) {
            $permLabel = 'عرض';
        } elseif (Str::contains($permissionName, 'delete')) {
            $permLabel = 'حذف';
        } else {
            $permLabel = $permissionName;
            $arr = explode(".", $permissionName);
            if(isset($arr[2])){//$arr[2] this the method part name example cmn-cities-archive-4
                $permLabel= __('permissions.'.$arr[2]);
            }
        }

        return $permLabel;
    }


    

    /**
     * Get the value of nodeObject
     */
    public function getNodeObject()
    {
        return $this->nodeObject;
    }

    /**
     * Set the value of nodeObject
     *
     * @return  self
     */
    public function setNodeObject($nodeObject)
    {
        $this->nodeObject = $nodeObject;

        return $this;
    }
}
