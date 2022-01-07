<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Owner;
use App\Models\Property;
use App\Models\Tenant;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $users = User::find(1);
        return [
            'status' => 200,
            'message' => __('users received Successfully'),
            'user' => $users,
        ];
    }
    public function index()
    {
        $users = User::with('owner.property')->get();
        return [
            'status' => 200,
            'message' => __('users received Successfully'),
            'data' => $users,
        ];
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::with('owner.property')->where('id', $id)->first();
        return [
            'status' => 200,
            'message' => 'users recived Successfully',
            'data' => $users,
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function withNews()
    {
        $owner = Owner::where('user_id', Auth::guard('sanctum')->id())->first()  ?? Tenant::where('user_id', Auth::guard('sanctum')->id())->first();

        $property = Owner::find($owner->id)->property;

        return [
            'status' => 200,
            'message' => 'data return successfully',
            'data' => [
                'user' => [

                    'name' => Auth::guard('sanctum')->user()->first_name . ' ' . Auth::guard('sanctum')->user()->last_name,
                    'image' => Auth::guard('sanctum')->user()->image,
                    'account_type' => Owner::where('user_id', Auth::guard('sanctum')->user()->id)->exists() ? 'Metrical Owner' : 'Metrical Tenant',
                ],
            ],

            'news' => News::where('community_id',  $owner->community_id)->limit(3)->get(),
            'properties' =>  $owner->property ?? [],


        ];
    }
}
