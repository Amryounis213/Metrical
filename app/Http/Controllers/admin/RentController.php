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



        if (!Rent::where('property_id', $request->property_id)->where('status', 'active')->exists()) {
            $request->merge([
                'from' => Carbon::parse($request->from)->format('Y-m-d H:m'),
                'to' => Carbon::parse($request->to)->format('Y-m-d H:m'),
            ]);
        } else {
            return 'Properties Have Rent';
        }


        $isRented = Rent::create($request->all());
        if ($isRented) {
            $offer = Offer::where('property_id', $request->property_id)->delete();
        }
        return redirect()->back();
    }
}
