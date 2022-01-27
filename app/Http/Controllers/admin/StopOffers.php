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
        $offers = Stopoffer::with(['Offer'])->get();
        return view('admin.properties.stop-offer', [
            'offers' => $offers,
            'title' => 'Show all stop offers'
        ]);
    }
    public function StopOffer(Request $request)
    {
    }
}
