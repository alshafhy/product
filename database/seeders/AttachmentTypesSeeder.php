<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\AttachmentType;
use Illuminate\Database\Seeder;

class AttachmentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attachmentTypes = config('initiation-data.attachmentTypes');
        //
        foreach ($attachmentTypes as $attachmentType) {
            $attachmentTypeData = AttachmentType::create([
                'title' => $attachmentType['title'] ,
                'description' => $attachmentType['description'] ,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')

            ]);
        }
    }
}
