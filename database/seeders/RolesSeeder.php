<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Overrides\Spatie\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = config('initiation-data.roles');
        //
        foreach ($roles as $role) {
            $roleData = Role::create([
                'name' => $role['name'] ,
                'guard_name' => $role['guard_name'] ,
                'ar_name' => $role['ar_name'] ,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

        }
    }
}
