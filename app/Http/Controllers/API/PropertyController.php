<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{

    public function index()
    {

        $properties = Property::with(['community', 'offer'])->where('offer_type', '!=', 'stop')->paginate(5);
        if ($properties) {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => __('messages.properties'),
                'properties' => $properties,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => __('messages.properties'),
                'properties' => [],
            ]);
        }
    }


    public function show($id)
    {
        $properties = Property::where('id', $id)->with(['community', 'offer'])->first();

        if ($properties) {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => __('messages.properties'),
                'property' => $properties,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => __('messages.properties'),
                'properties' => [],
            ]);
        }
    }

    public function Status($status)
    {
        $properties = Property::with('community')->where('status', $status)->get();
        $status = Property::with('community')->where('status', $status)->count();
        if ($status > 0) {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => __('messages.properties'),
                'property' => $properties,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => __('messages.properties'),
                'properties' => [],
            ]);
        }
    }
    public function type($offer_type)
    {
        $properties = Property::with('community')
            ->where('offer_type', $offer_type)
            ->get();
        $status = Property::with('community')->where('offer_type', $offer_type)->count();
        if ($status > 0) {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => __('messages.properties'),
                'property' => $properties,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => __('messages.properties'),
                'properties' => [],
            ]);
        }
    }

    public function shortTerm($short)
    {
        $properties = Property::where('is_shortterm', $short)->get();
        return [
            'status' => true,
            'code' => 200,
            'message' => __('messages.properties'),
            'properties' => $properties,
        ];
    }
}
