<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\SystemComponent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemComponentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_components')->delete();
        $systemComponents = config('initiation-data.systemComponents');
        //
        foreach ($systemComponents as $key =>  $systemComponent) {
            $parent_id = 0 ;
            $parent_route_name = $systemComponent['parent_route_name'] ;
            $config = $systemComponent['config'] ?? NULL ;
            if($parent_route_name){
                $parent_data = SystemComponent::where("route_name",$parent_route_name)->first();
                if ($parent_data ){
                    $parent_id  = $parent_data->id;
                }
            }
            
            $systemComponentData = SystemComponent::create([
                'comp_name' => $systemComponent['route_name'] ,
                'comp_ar_label' => $systemComponent['comp_name'] ,
                'description' => $systemComponent['description'] ?? '' ,
                'comp_type' => $systemComponent['comp_type'] ,
                'route_name' => $systemComponent['route_name'] ,
                // 'system_name' => $systemComponent['command'] ,
                // 'model_name' => $systemComponent['model_name'] ,
                'prefix' => $systemComponent['prefix'] ,
                'parent_id' => $parent_id,
                'icon_name' => $systemComponent['icon'] ,
                'config' =>trim($config)  ,
                // 'object_css' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

        }
        
    }
}
