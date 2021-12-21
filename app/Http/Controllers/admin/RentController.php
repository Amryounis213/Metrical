<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Rent;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RentController extends Controller
{
    //

    public function store(Request $request)
    {




        $request->merge([
            'from' => Carbon::parse($request->from)->format('Y-m-d H:m'),
            'to' => Carbon::parse($request->to)->format('Y-m-d H:m'),
        ]);

        $isRented = Rent::create($request->all());
        if ($isRented) {
            $offer = Offer::where('property_id', $request->property_id)->delete();
        }
        return redirect()->back();
    }
}
