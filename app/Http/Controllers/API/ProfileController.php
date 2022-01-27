<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DeliveryPermit;
use App\Models\MoveIn;
use App\Models\MoveOut;
use App\Models\WorkPermit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function moveIn()
    {
        $user_id = Auth::guard('sanctum')->id();

        // $move_in = MoveIn::where('user_id', $user_id)->get();
        $move_in = MoveIn::where('user_id', $user_id)->get([
            'created_at', 'date', 'start_time', 'end_time', 'full_name', 'mobile', 'contact', 'country'
        ]);

        return  response()->json(
            [
                'status' => true,
                'code' => 200,
                'message' => 'Move in Service For Auth User',
                'data' => $move_in,
            ],
            200
        );
    }
    public function moveOut()
    {
        $user_id = Auth::guard('sanctum')->id();

        $move_out = MoveOut::where('user_id', $user_id)->get([
            'created_at', 'date', 'start_time', 'end_time', 'full_name', 'mobile',
        ]);
        return  response()->json(
            [
                'status' => true,
                'code' => 200,
                'message' => 'Move Out Service For Auth User',
                'data' => $move_out,
            ],
            200
        );
    }
    public function Delivery()
    {
        $user_id = Auth::guard('sanctum')->id();

        $delivery = DeliveryPermit::where('user_id', $user_id)->get([
            'created_at', 'delivery_company', 'date', 'resident_name', 'resident_mobile', 'resident_country', 'contact'

        ]);
        return  response()->json(
            [
                'status' => true,
                'code' => 200,
                'message' => 'delivery Service For Auth User',
                'data' => $delivery,
            ],
            200
        );
    }
    public function WorkPermit()
    {
        $user_id = Auth::guard('sanctum')->id();

        $work_permit = WorkPermit::where('user_id', $user_id)->get([
            'created_at', 'contractor_name', 'contractor_contact_name', 'number_of_staff', 'mobile', 'country', 'start_time', 'end_time'
        ]);
        return  response()->json(
            [
                'status' => true,
                'code' => 200,
                'message' => 'Work Permit Service For Auth User',
                'data' => $work_permit,
            ],
            200
        );
    }
}
