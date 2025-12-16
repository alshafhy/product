<?php

namespace Database\Seeders;

use App\Models\SystemRelease;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SystemReleasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('system_releases_features')->delete();
        DB::table('system_releases')->delete();
        $systemReleases = config('initiation-data.systemReleases');
        //
        foreach ($systemReleases as $key =>  $systemRelease) {
            // $parent_id = 0 ;
            // $parent_route_name = $systemComponent['parent_route_name'] ;
            // $config = $systemComponent['config'] ?? NULL ;
            // if($parent_route_name){
            //     $parent_data = SystemComponent::where("route_name",$parent_route_name)->first();
            //     if ($parent_data ){
            //         $parent_id  = $parent_data->id;
            //     }
            // }
            // new Carbon('12-10-2023')
            $systemComponentData = SystemRelease::create([
                'version_number' => $systemRelease['version_number'] ,
                'release_date' =>  $systemRelease['release_date'] ,
                'is_current' => $systemRelease['is_current'] ,
                'order' => $systemRelease['order'] ,
                 
            ]);
            $systemComponentData->features()->createMany($systemRelease['system_releases_features']);
        }
        
    }
}
