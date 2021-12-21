<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
