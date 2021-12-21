<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::get();
        $status = News::count();

        if ($status > 0) {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => __('messages.news'),
                'news' => $news,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => __('messages.news'),
                'news' => $news,
            ]);
        }
    }

    public function newsByCommunity($id)
    {
        $news = News::where('community_id', $id)->exists();
        if ($news) {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => __('messages.news'),
                'news' => News::where('community_id', $id)->get(),
            ]);
        }
        return response()->json([
            'status' => 404,
            'message' =>  __('messages.news.notfound'),
            'news' => $news,
        ]);
    }

    public function show($id)
    {
        $news = News::where('id', $id)->first();
        if ($news) {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' =>  __('messages.news'),
                'news' => $news,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' =>  __('messages.news'),
                'news' => $news,
            ]);
        }
    }
}
