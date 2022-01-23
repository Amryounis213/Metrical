<?php

namespace App\Imports;

use App\Models\Property;
use App\Models\Propery;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class ProperysImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Property([
            'name_en' => $row[0],
            'name_gr' => $row[1]
        ]);
    }
}
