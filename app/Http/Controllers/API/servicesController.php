<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DeliveryPermit;
use App\Models\MoveIn;
use App\Models\MoveOut;
use App\Models\WorkPermit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class servicesController extends Controller
{

    public function moveIn(Request $request)
    {
        $user_id = Auth::guard('sanctum')->id();
        $request->merge([
            'user_id' => $user_id
        ]);

        $request->validate([
            'property_id' => 'required|exists:properties,id'
        ]);
        $moveIn = MoveIn::create($request->all());
        if ($moveIn) {
            return response()->json([
                'status' => true,
                'code' => 201,
                'message' => __('messages.Enquiry'),
                'data' => $moveIn,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => __('messages.Enquiry'),
                'data' => $moveIn,
            ]);
        }
    }


    public function moveOut(Request $request)
    {   
        $user_id = Auth::guard('sanctum')->id();
        $request->merge([
            'user_id' => $user_id
        ]);
        
        $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id'
        ]);
        $moveOut = MoveOut::create($request->all());
        if ($moveOut) {
            return response()->json([
                'status' => true,
                'code' => 201,
                'message' => __('messages.Enquiry'),
                'data' => $moveOut,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => __('messages.Enquiry'),
                'data' => $moveOut,
            ]);
        }
    }


    public function workPermit(Request $request)
    {
        $user_id = Auth::guard('sanctum')->id();
        $request->merge([
            'user_id' => $user_id
        ]);
        
        $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id'
        ]);
        $WorkPermit = WorkPermit::create($request->all());
        if ($WorkPermit) {
            return response()->json([
                'status' => true,
                'code' => 201,
                'message' => __('messages.Enquiry'),
                'data' => $WorkPermit,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => __('messages.Enquiry'),
                'data' => $WorkPermit,
            ]);
        }
    }

    public function deliveryPermit(Request $request)
    {
        $user_id = Auth::guard('sanctum')->id();
        $request->merge([
            'user_id' => $user_id
        ]);
        
        $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id'
        ]);
        $DeliveryPermit = DeliveryPermit::create($request->all());
        if ($DeliveryPermit) {
            return response()->json([
                'status' => true,
                'code' => 201,
                'message' => __('messages.Enquiry'),
                'data' => $DeliveryPermit,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => __('messages.Enquiry'),
                'data' => $DeliveryPermit,
            ]);
        }
    }
}
