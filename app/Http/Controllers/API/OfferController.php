<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $offers = Offer::where('type', '!=', 'stop')->get();
        return response()->json([
            'status' => 200,
            'message' => 'Offers recived Successfully',
            'offer' => $offers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'full_name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'type' => 'required',
            'sale_price' => [Rule::requiredIf($request->type == 'sale')],
            'rent_price' => [Rule::requiredIf($request->type == 'rent')],
            'rent_start_date' => [Rule::requiredIf($request->type == 'rent')],
            'rent_end_date' => [Rule::requiredIf($request->type == 'rent')],
            'property_id' => 'required|exists:properties,id'
        ]);

        $request->merge([
            'user_id' => Auth::guard('sanctum')->id(),
        ]);
        $owner_id = User::find($request->user_id)->owner->id;
        $property_id = Property::find($request->property_id)->owner_id;
        if ($owner_id == $property_id) {
            if (!Offer::where('property_id', $request->property_id)->exists()) {
                $offers = Offer::create($request->all());
                return response()->json([
                    'status' => true,
                    'code' => 201,
                    'message' => 'Offer  sent Successfully',
                    'offer' => $offers,
                ]);
            }

            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'Offer Not Sent (Property Has Offer)',
                'offer' => [],
            ]);
        }


        return response()->json([
            'status' => false,
            'code' => 404,
            'message' => 'Offer Not Sent (You are not the owner of the property)',
            'offer' => [],
        ]);
    }


    public function storeOffer(Request $request, $type)
    {
        $validation = Validator::make($request->all(), [
            'full_name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'sale_price' => [Rule::requiredIf($type == 'sale')],
            'rent_price' => [Rule::requiredIf($type == 'rent')],
            'rent_start_date' => [Rule::requiredIf($type == 'rent')],
            'rent_end_date' => [Rule::requiredIf($type == 'rent')],
            'property_id' => 'required|exists:properties,id'
        ]);

        $request->merge([
            'user_id' => Auth::guard('sanctum')->id(),
            'type' => $type,
        ]);
        $owner_id = User::find($request->user_id)->owner->id;
        $property_id = Property::find($request->property_id)->owner_id;
        if ($owner_id == $property_id) {
            // return Offer::where('property_id', $request->property_id)->where('type', $type)->get();
            if (!Offer::where('property_id', $request->property_id)->where('type', $type)->exists()) {
                $offers = Offer::create($request->all());
                return response()->json([
                    'status' => true,
                    'code' => 201,
                    'message' => 'Offer  sent Successfully (Waiting for accepting Admin)',
                    'offer' => $offers,
                ]);
            }
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'Offer Not Sent (Property Has Pending Offer )',
                'offer' => [],
            ]);
        }


        return response()->json([
            'status' => false,
            'code' => 404,
            'message' => 'Offer Not Sent (You are not the owner of the property)',
            'offer' => [],
        ]);
    }
}
