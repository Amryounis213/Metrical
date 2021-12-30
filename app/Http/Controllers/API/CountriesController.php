<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CountriesController extends Controller
{
    public function showallcountries()
    {
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'All Countries',
            'countries' => country::get(['id', 'name']),
        ]);
    }


    public function showCitiesByCountry($id)
    {
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'All Cities',
            'cities' => City::where('country_id',  $id)->get(['id', 'name', 'country_id']),
        ]);
    }

    public function termswithcountries(Request $request)
    {
        //  $term = 'term_' . strval($this->name . app()->getLocale());

        if ($request->header('lang') == 'en') {
            $term = User::$term_en;
        } elseif ($request->header('lang') == 'ar') {
            $term = User::$term_ar;
        } else {
            $term = User::$term_gr;
        }
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Static Data',
            'setting' => [
                'country' => [country::find(231)],
                'terms' =>  $term,
            ],
        ]);
    }
}
