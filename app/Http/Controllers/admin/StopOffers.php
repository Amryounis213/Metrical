<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Stopoffer;
use Illuminate\Http\Request;

class StopOffers extends Controller
{
    public function index()
    {
        $offers = Stopoffer::get();
        // return $offers;
        return view('admin.properties.stop-offer',[
            'offers' => $offers,
            'title' => 'Show All Communities'
        ]);
    }
    public function StopOffer(Request $request)
    {
        # code...
    }
}
