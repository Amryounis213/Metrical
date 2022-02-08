<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function index()
    {
        $user = Auth::guard('sanctum')->user();
        foreach ($user->unreadNotifications as $not) {
            
            $data[] = [
                'id' => $not->id,
                'title' =>$not->data['title'],
                'body' => $not->data['body'],
            ];
        }
        return  response()->json([
            'status' => true,
            'code' => 200 ,
            'message' => '',
            'data' => $data,
        ], 200 );
        
    }
    public function delete($id)
    {
        
        $user = Auth::guard('sanctum')->user();
        $notifciation = $user->notifications()->findOrFail($id);
     
        $notifciation->markAsRead();
        return  response()->json([
            'status' => true,
            'code' => 200 ,
            'message' => '',
            'data' => 'Delete Notification',
        ], 200 );
    }
}
