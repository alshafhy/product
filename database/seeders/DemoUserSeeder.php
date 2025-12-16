<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $branchData =  Branch::where("is_main_branch",1)->first();
        // dd($branchData);
        // $demoUser = User::create([
        //     'name' => 'مدير النظام',
        //     'username' => 'admin',
        //     'email' => 'admin@demo.com',
        //     'branch_id'=>$branchData->id,
        //     'password' => Hash::make('Admin@123987'),
        //     'remember_token' => Str::random(10)
        // ]);

        // $demoUser->assignRole('admin');

        $users = config('initiation-data.users');
        //
        foreach ($users as $user) {
            if (isset($user['password']) && $user['password']) {
                $password = Hash::make($user['password']);
            } else {
                $password = Hash::make($user['username'] . "@demo");
            }
            $userData = User::create([
                'name' => $user['name'],
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => $password,
                'remember_token' => null
            ]);
            if (isset($user['role']) && $user['role']) {
                $userData->assignRole($user['role']);
            }
        }


    }
}

?>