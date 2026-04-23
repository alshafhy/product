<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RolesSeeder::class,
            SystemComponentsSeeder::class,
            PermissionsSeeder::class, 
            DemoUserSeeder::class,
            SystemReleasesSeeder::class,
            FoundationLookupSeeder::class,
            ProductSeeder::class,
            PeopleSeeder::class,
            SaleInvoicePermissionsSeeder::class,
            PurchaseInvoicePermissionsSeeder::class,
            TreasuryPermissionsSeeder::class,
            InstallmentPermissionsSeeder::class,
            FoundationSeeder::class,
            ProductPermissionsSeeder::class,
            CustomerSupplierPermissionsSeeder::class,
            ReportPermissionsSeeder::class,
        ]);
    }
}
