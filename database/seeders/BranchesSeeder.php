<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branches = config('initiation-data.branches');
        //
        foreach ($branches as $branch) {
            $branchData = Branch::create([
                'name' => $branch['name'] ,
                'city_id' => $branch['city_id'] ,
                'district_id' => $branch['district_id'] ,
                'is_main_branch' => $branch['is_main_branch'] ,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')

            ]);
        }
    }
}
