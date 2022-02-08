<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Property;
use App\Models\Stopoffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StopOfferController extends Controller
{
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [

            'email' => 'required',
            'reason' => 'required',
            'mobile' => 'required',
            'full_name' => 'required',
        ]);
        if ($validation->fails()) {

            return  response()->json([
                'status' => false,
                'code' => 422,
                'message' => 'validation error',
                'data' => $validation->errors(),
            ], 422);
        }
        $request->merge([
            'user_id' => Auth::guard('sanctum')->id(),
        ]);

        $stop = Stopoffer::create($request->all());
        $offer = Offer::find($request->offer_id);
        $property = Property::find($offer->property_id);
        $property->update([
            'offer_type' => 'stop',
        ]);
        $offer->delete();
        return response()->json([
            'status' => 201,
            'code' => true,
            'message' => __('messages.Amenity'),
            'data' => $stop,
        ]);
    }
}
