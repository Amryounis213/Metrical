<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\DeviceToken;
use App\Models\Event;
use App\Models\InterestedUser;
use App\Models\User;
use App\Notifications\InvoiceEvents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class EventsController extends Controller
{

    public function result(Request $request)
    {

        $events = Event::where('title_en', 'LIKE', '%' . $request->name . '%')->paginate(10);

        return view('admin.events.result', [
            'events' => $events,
            'title' => 'Show All Results'
        ]);
    }

    public function index()
    {
        $events = Event::with('community')->paginate(5);
        // return $events;
        return view('admin.events.index', [
            'events' => $events,
            'title' => 'Show All Events'
        ]);
    }
    public function create()
    {
        $event = new Event();
        $communites = Community::get();
        return view('admin.events.create', [
            'title' => 'Create New Event',
            'communites' => $communites,
            'event' => $event
        ]);
    }

    public function store(Request $request)
    {


        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'title_gr' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'description_gr' => 'required',
            'address' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'community_id' => 'required',
            'image_url' => 'required'
        ]);
        $input = $request->all();
        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url'); // UplodedFile Object

            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);
            $request->merge([
                'image_url' => $image_path,
            ]);
            $input['image_url'] = $image_path;
        }
        $event = Event::create($input);

        $users = User::get();
        Notification::send($users, new InvoiceEvents($event));


        $users = User::whereHas('deviceTokens', function ($query) {
            $query->where('user_id', '!=', null);
        })->get();

        foreach ($users as $user) {
            $token = DeviceToken::where('user_id', $user->id)->first('token');
            $this->sendNotificationrToUser($token->token, $event);
        }

        return redirect()->route('events.index')->with('create', 'the Event is created Successfully');
    }

    public function show($id)
    {
    }
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $communites = Community::get();
        return view('admin.events.edit', [
            'event' => $event,
            'communites' => $communites,
            'title' => 'Edit The Event'
        ]);
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'title_gr' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'description_gr' => 'required',
            'address' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'community_id' => 'required',
        ]);
        $event = Event::findOrFail($id);
        $input = $request->all();
        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url'); // UplodedFile Object

            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);
            $request->merge([
                'image_url' => $image_path,
            ]);
            $input['image_url'] = $image_path;
        }

        $event->update($input);
        return redirect()->route('events.index')->with('edit', 'The event  ( ' . $event->title_en . ') is updated');
    }
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('events.index')->with('delete', 'The event ( ' . $event->title_en . ') is deleted');
    }


    public function sendNotificationrToUser($token, $event)
    {

        // FCM Configration
        $SERVER_API_KEY = 'AAAAji5vbXQ:APA91bGg4V1H3v-j_pQMvyFvVcFmGrZZHOhoCeqjdmClFKgn7irpeeaesyUnUaAqsnJ9N9dP5iv9chgGFgfPilaCmj1RqUQ1yu_QNsGCeU9dzmwnbcBBsDkrodp1pA4DIqhTq2NCemtP';
        $token_1 = $token;
        $data = [
            "registration_ids" => [
                $token_1
            ],
            "notification" => [

                "title" => 'New Event for You',

                "body" => $event->community->name_en . ' Community has a new event waiting for you',

                "sound" => "default" // required for sound on ios

            ],

        ];

        $dataString = json_encode($data);

        $headers = [

            'Authorization: key=' . $SERVER_API_KEY,

            'Content-Type: application/json',

        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
    }
}
