<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommunityCollection;
use App\Models\Community;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $community = Community::get();
        if ($community) {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => __('messages.communities'),
                'community' => $community,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => __('messages.communities'),
                'community' => $community,
            ]);
        }
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

        $community = Community::with('properties')->where('id', $id)->first();
        if ($community) {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => __('messages.communities'),
                'data' => $community,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => __('messages.communities'),
                'data' => null,
            ]);
        }
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

    public function Status($id, $status)
    {
        $communities = Community::whereHas('properties', function ($query) use ($status, $id) {
            $query->where('status', $status);
        })->where('id', $id)->get();
        return response()->json([
            'status' => 200,
            'message' => __('messages.properties'),
            'data' => $communities,
        ]);
    }
}
