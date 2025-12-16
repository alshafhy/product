<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AssayImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // dd($rows[4] );
        // dd($rows[5] );
        dd($rows[61] );
        dd($rows[62] );
        // foreach ($rows as $row) 
        // {
        //     User::create([
        //         'name' => $row[0],
        //     ]);
        // }
    }
}