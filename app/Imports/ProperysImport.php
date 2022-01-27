<?php

namespace App\Imports;

use App\Models\Owner;
use App\Models\Property;
use App\Models\Propery;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProperysImport implements ToModel, WithHeadingRow

{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $owner = Owner::where('email', $row['email'])->first();

        return new Property([
            'name_ar' => $row['name_ar'],
            'name_en' => $row['name_en'],
            'name_gr' => $row['name_gr'],
            'area' => $row['area'],
            'reference' => $row['reference'],
            'feminizations' => $row['feminizations'],
            'is_shortterm' => $row['is_shortterm'],
            'bedroom' => $row['bedroom'],
            'bathroom' => $row['bathroom'],
            'gate' => $row['gate'],
            'address_ar' => $row['address_ar'],
            'address_en' => $row['address_en'],
            'address_gr' => $row['address_gr'],
            'description_ar' => $row['description_ar'],
            'description_gr' => $row['description_gr'],
            'description_en' => $row['description_en'],
            'city' => $row['city'],
            'location_latitude' => $row['location_latitude'],
            'location_longitude' => $row['location_longitude'],
            'image_url' => $row['image_url'],
            'type' => $row['type'],
            'offer_type' => $row['offer_type'],
            'status' => $row['status'],
            'community_id' => $row['community_id'],
            'date_added' => Carbon::now(),
            'owner_id' => $owner->id ?? null,
        ]);
    }
}
