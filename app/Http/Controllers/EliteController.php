<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Community;
use App\Models\country;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EliteController extends Controller
{
    public function showformadduser()
    {
        $properties1 = Property::select('id', 'name_en', 'owner_id')->where('owner_id', null)->get();
        $properties2 = Property::select('id', 'name_en', 'tenant_id')->where('tenant_id', null)->get();
        $str_random = Str::random(8);

        //$properties1 = Property::get();
        return view('admin.users.newuser', [
            'title' => 'Create New Users',
            'countries' => country::select('id', 'name')->get(),
            'countries2' => country::select('id', 'name')->get(),
            'cities' => City::where('country_id', 231)->get(['id', 'name']),
            'communities' => Community::get(['id', 'name_en']),
            'properties1' => $properties1,
            'properties2' => $properties2,
            'str_random' => $str_random,
            'phonecode' => country::select('phonecode')->get(),
        ]);
    }

    public function GetPropertyByCommunity($id)
    {
        $properties = Property::where('community_id', $id)->where('owner_id', null)->get();
        return response()->json($properties);
    }


    public function TenantGetPropertyByCommunity($id)
    {
        $properties = Property::where('community_id', $id)->where('tenant_id', null)->get();
        return response()->json($properties);
    }

    public function GetPhonecodeByCountry($id)
    {
        $countries = country::where('id', $id)->get();
        return response()->json($countries);
    }
}
