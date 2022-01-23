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
                'code' => 200,
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
                'code' => 200,
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
                'code' => 200,
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
                'code' => 200,
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

    public function propertiesfilter(Request $request)
    {
        if ($request->search) {

            $property = Property::where('name_en', 'LIKE', '%' . $request->search . '%')
                ->orWhere('name_ar',  'LIKE', '%' . $request->search . '%')
                ->orWhere('name_gr', 'LIKE', '%' . $request->search . '%')
                ->orWhere('description_ar', 'LIKE', '%' . $request->search . '%')
                ->orWhere('description_gr', 'LIKE', '%' . $request->search . '%')
                ->orWhere('description_en',  'LIKE', '%' . $request->search . '%')->paginate($request->limit ?? 5);
        } else {
            $property = Property::when($request->community_id, function ($query) use ($request) {
                $query->where('community_id', $request->community_id);
            })->when($request->offer_type, function ($query) use ($request) {
                $query->where('offer_type', $request->offer_type);
            })->when($request->city, function ($query) use ($request) {
                $query->where('city', $request->city);
            })->when($request->bedroom, function ($query) use ($request) {
                $query->where('bedroom', $request->bedroom);
            })->when($request->bathroom, function ($query) use ($request) {
                $query->where('bathroom', $request->bathroom);
            })->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })->when($request->type, function ($query) use ($request) {
                $query->where('type', $request->type);
            })->when($request->from, function ($query) use ($request) {
                $query->whereBetween('area', [$request->from ?? 0, $request->to ?? 0]);
            })->when($request->shortterm, function ($query) use ($request) {
                $query->where('is_shortterm', $request->shortterm);
            })->paginate($request->limit ?? 5);
        }


        // $property = Property::where('community_id', $request->community_id)
        //     ->where('offer_type', $request->offer_type)
        //     ->where('city', $request->city)
        //     ->where('bedroom', $request->bedroom)
        //     ->where('bathroom', $request->bathroom)
        //     ->where('status', $request->status)
        //     ->where('type', $request->type)
        //     ->whereBetween('area', [$request->from, $request->to])
        //     ->get();

        if ($property->count() > 0) {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Property return succesfully',
                'properties' => $property,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => 200,
                'message' => 'There is no property',
                'properties' => $property,
            ]);
        }
    }
}
