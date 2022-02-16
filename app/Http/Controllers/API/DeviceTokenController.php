<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceTokenController extends Controller
{
    public function updateDeviceToken(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'device' => 'required'
        ]);

        $user = Auth::guard('sanctum')->user();

        $user->deviceTokens()->update($request->all());

        return  response()->json([
            'status' => true,
            'code' => 201,
            'message' => 'Device Token Updated Successfully',
            'data' => $user->deviceTokens()->first(),
        ], 201);
    }
}
