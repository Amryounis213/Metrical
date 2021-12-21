<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\InterestedUser;
use App\Notifications\SendReminderForEventNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::get();
        $status = Event::count();
        if ($status > 0) {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => __('messages.events'),
                'events' => $events,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => __('messages.events'),
                'events' => [],
            ]);
        }
    }
    public function show($id)
    {
        $events = Event::where('id', $id)->first();
        if ($events) {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => __('messages.events'),
                'events' => $events,
            ]);
        }
        return response()->json([
            'status' => false,
            'code' => 404,
            'message' => __('messages.events.notfound'),
            'events' => [],
        ]);
    }
    public function eventsByCommunity($id)
    {
        $events = Event::where('community_id', $id)->exists();
        if ($events) {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => __('messages.events'),
                'events' => Event::where('community_id', $id)->get(),
            ]);
        }
        return response()->json([
            'status' => false,
            'code' => 404,
            'message' => __('messages.events.notfound'),
            'events' => [],
        ]);
    }

    // interested or not

    public function interested(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $request->validate([
            'status' => 'required',
            'event_id' => 'required'
        ]);

        $request->merge([
            'user_id' => $user->id
        ]);
        // $user->notify(new SendReminderForEventNotification(Event::find($request->event_id)));
        InterestedUser::create($request->all());
        if ($request->status == 1) {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => __('messages.interested'),

            ]);
        }

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => __('messages.notInterested'),

        ]);
    }
}
