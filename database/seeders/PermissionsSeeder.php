<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\SystemComponent;
use Illuminate\Database\Seeder;
use App\Overrides\Spatie\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $permissions = config('initiation-data.permissions');
        // //
        // foreach ($permissions as $permission) {
        //     $permissionData = Permission::create([
        //         'name' => $permission['name'] ,
        //         'guard_name' => $permission['guard_name'] ,
        //         'system_component_id' => $permission['system_component_id'] ,
        //         'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //         'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        //     ]);

        // }
        $actions = array('index','edit','show','create','delete');

        $systemComponents = SystemComponent::where("comp_type",3)->get();
        // dd($systemComponents);
        foreach ($systemComponents as $component) {
            foreach ($actions  as $action) {
                $permissionData = Permission::create([
                    'name' => $component->prefix .".".$component->route_name.".".$action  ,
                    'guard_name' => 'web' ,
                    'system_component_id' => $component->id ,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);
            }
            
        }

        $systemComponents = SystemComponent::where("comp_type",4)->get();
        foreach ($systemComponents as $component) {
            $permissionData = Permission::create([
                'name' => "reports.".$component->route_name  ,
                'guard_name' => 'web' ,
                'system_component_id' => $component->id ,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]); 
        } 
    }
}
