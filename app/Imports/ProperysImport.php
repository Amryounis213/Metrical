<?php

namespace App\Imports;

use App\Models\Owner;
use App\Models\Property;
use App\Models\Propery;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProperysImport implements ToCollection, WithHeadingRow
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function collection(Collection $rows)
    {

        Validator::make($rows->toArray(), [
            '*.name_ar' => 'required',
            '*.name_en' => 'required',
            '*.name_gr' => 'required',
            '*.area' => 'required',
            '*.reference' => 'required',
            '*.feminizations' => 'required',
            '*.is_shortterm' => 'required',
            '*.bedroom' => 'required',
            '*.bathroom' => 'required',
            '*.gate' => 'required',
            '*.address_ar' => 'required',
            '*.address_en' => 'required',
            '*.address_gr' => 'required',
            '*.description_ar' => 'nullable',
            '*.description_gr' => 'nullable',
            '*.description_en' => 'nullable',
            '*.city' => 'nullable',
            '*.type' => 'required',
            '*.offer_type' => 'required',
            '*.community_id' => 'required',
            '*.owner_id' => 'nullable',
            '*.floor' => 'nullable',

        ])->validate();

        foreach ($rows as $row) {
            $owner = Owner::where('email', $row['email'])->first();
            Property::create([
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
                'description_ar' => $row['description_ar'] ?? null,
                'description_gr' => $row['description_gr'] ?? null,
                'description_en' => $row['description_en'] ?? null,
                'city' => $row['city'],
                'location_latitude' => $row['location_latitude'],
                'location_longitude' => $row['location_longitude'],
                'image_url' => 'btjHMn6URSB49gUBEtMH6jVmdxFDF5yQrfAAyfh6.jpg',
                'type' => $row['type'],
                'offer_type' => $row['offer_type'],
                'status' => '1',
                'community_id' => $row['community_id'],
                'date_added' => Carbon::now(),
                'ownership_date' => Carbon::now(),
                'owner_id' => $owner->id ?? null,
                'floor' => $row['floor'] ?? null,
            ]);
        }
    }
    /*   public function model(array $row)
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
            'floor' => $row['floor'],
        ]);
    }


    public function rules(): array
    {
        return [
            'name_en' => 'request',
            'name_ar' => 'request',
            'name_gr' => 'request',
            'image_url' => 'nullable',
            'images' => 'nullable|max:10240',
            'community_id' => 'request|exists:communities,id',
            'description_ar' => 'nullable',
            'description_ar' => 'nullable',
            'description_ar' => 'nullable',
            'address_ar' => 'nullable',
            'address_en' => 'nullable',
            'address_gr' => 'nullable',
            'area' => 'request',
            'feminizations' => 'nullable',
            'bedroom' => 'request',
            'bathroom' => 'request',
            'status' => 'request',
            'is_shortterm' => 'request',
            'offer_type' => 'request',
            'type' => 'request',
            'gate' => 'request',
            'amenities' => 'nullable',
            'floor' => 'request',
        ];
    } */
}
