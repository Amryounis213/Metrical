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
                'status' => true,
                'code' => 200,
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
            'status' => true,
            'code' => 200,
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
            'status' => true,
            'code' => 200,
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
        $isIntersted = InterestedUser::where('user_id', $user->id)->where('event_id', $request->event_id)->exists();

        if (!$isIntersted) {
            InterestedUser::create($request->all());
            if ($request->status == 1) {
                return response()->json([
                    'status' => true,
                    'code' => 200,
                    'message' => __('messages.interested'),
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'code' => 200,
                    'message' => __('messages.notInterested'),
                ]);
            }
        } else {
            $event = InterestedUser::where('user_id', $user->id)->where('event_id', $request->event_id)->first();
            $event->update([
                'status' => $request->status,
            ]);


            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => $request->status ? 'You have successfully interested this event' : 'You have successfully NOT interested this event',
            ]);
        }

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => __('messages.notInterested'),
        ]);
    }
}
