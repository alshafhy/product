<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionsSeeder::class, // must run first — all others depend on it
            SystemComponentsSeeder::class,
            DemoUserSeeder::class,
            SystemReleasesSeeder::class,
            FoundationLookupSeeder::class,
            ProductSeeder::class,
            PeopleSeeder::class,
            FoundationSeeder::class,
        ]);
    }
}
