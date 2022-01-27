<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ContactWithAdmin;
use App\Models\EmergencyContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{
    public function showContent()
    {
        //  dd(Auth::guard('sanctum')->user()->id);
        $contacts = EmergencyContact::where('user_id', Auth::guard('sanctum')->user()->id)->latest()->limit(2)->get();
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Emergency Contacts',
            'contacts' => $contacts
        ]);
    }

    public function AddEmergencyContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'country' => 'required',
        ]);

        $contacts = EmergencyContact::create([
            'user_id' => Auth::guard('sanctum')->user()->id,
            'full_name' => $request->name,
            'mobile' => $request->mobile,
            'country' => $request->country,
        ]);

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Emergency Contacts',
            'contacts ' => $contacts
        ]);
    }
}
