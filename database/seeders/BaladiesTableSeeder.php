<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaladiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('baladies')->delete();
        
        DB::table('baladies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'الحرم',
                'city_id' => 1,
                'created_at' => '2022-07-12 05:39:58',
                'updated_at' => '2022-07-12 05:39:58',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'العوالي',
                'city_id' => 1,
                'created_at' => '2022-07-12 05:40:12',
                'updated_at' => '2022-07-12 05:40:12',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'قباء',
                'city_id' => 1,
                'created_at' => '2022-07-12 05:40:29',
                'updated_at' => '2022-07-12 05:40:29',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'العقيق',
                'city_id' => 1,
                'created_at' => '2022-07-12 05:43:07',
                'updated_at' => '2022-07-12 05:43:07',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'أحد',
                'city_id' => 1,
                'created_at' => '2022-07-12 05:43:22',
                'updated_at' => '2022-07-12 05:43:22',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'العيون',
                'city_id' => 1,
                'created_at' => '2022-07-12 05:45:50',
                'updated_at' => '2022-07-12 05:45:50',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'البيداء',
                'city_id' => 1,
                'created_at' => '2022-07-12 05:46:00',
                'updated_at' => '2022-07-12 05:46:00',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'العاقول',
                'city_id' => 1,
                'created_at' => '2022-07-12 05:46:09',
                'updated_at' => '2022-07-12 05:46:09',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'أبيار الماشي',
                'city_id' => 1,
                'created_at' => '2022-07-12 05:46:21',
                'updated_at' => '2022-07-12 05:46:21',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'الفريش',
                'city_id' => 1,
                'created_at' => '2022-07-12 05:46:31',
                'updated_at' => '2022-07-12 05:46:31',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'الصويدرة',
                'city_id' => 1,
                'created_at' => '2022-07-12 05:46:41',
                'updated_at' => '2022-07-12 05:46:41',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'المندسة',
                'city_id' => 1,
                'created_at' => '2022-07-12 05:46:51',
                'updated_at' => '2022-07-12 05:46:51',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'المليليح',
                'city_id' => 1,
                'created_at' => '2022-07-12 05:47:02',
                'updated_at' => '2022-07-12 05:47:02',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}