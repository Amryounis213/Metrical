<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendMessageToAdminEvent;
use App\Http\Controllers\Controller;
use App\Listeners\SendMessageToAdmin;
use App\Models\ContactWithAdmin;
use App\Notifications\ContactWithAdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactWithAdminController extends Controller
{

    public function result(Request $request)
    {

        $contacts = ContactWithAdmin::where('name', 'LIKE', '%' . $request->name . '%')->paginate(10);

        return view('admin.contact.result', [
            'contacts' => $contacts,
            'title' => 'Show All Results'
        ]);
    }
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'phone_number' => 'nullable',
        ]);
        if ($validation->fails()) {

            return  response()->json([
                'status' => false,
                'code' => 422,
                'message' => '',
                'data' => $validation->errors(),
            ], 422);
        }

        $user = Auth::guard('sanctum')->user();
        $request->merge([
            'user_id' => $user->id
        ]);

        $contact = ContactWithAdmin::create($request->all());
        // notify notification
        event(new SendMessageToAdminEvent($contact));

        return  response()->json([
            'status' => true,
            'code' => 201,
            'message' => __('messages.contact'),
            'data' => $contact,
        ]);
    }
}
