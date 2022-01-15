<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function result(Request $request)
    {

        $news = News::where('title_en', 'LIKE', '%' . $request->name . '%')->paginate(10);

        return view('admin.news.result', [
            'news' => $news,
            'title' => 'Show All Results'
        ]);
    }
    public function index()
    {
        Gate::authorize('news.view');

        $news = News::with('community')->paginate(5);
        // return $news;
        return view('admin.news.index', [
            'news' => $news,
            'title' => 'Show All News',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('news.create');
        $new = new News();
        $communities = Community::get();
        return view('admin.news.create', [
            'title' => 'Create New News',
            'new' => $new,
            'communities' => $communities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'title_gr' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'description_gr' => 'required',
            'image_url' => 'required',
            'community_id' => 'required',
        ]);
        // return $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image'); // UplodedFile Object

            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);
            $request->merge([
                'image_url' => $image_path,
            ]);
        }
        if ($request->hasfile('photos')) {
            foreach ($request->file('photos') as $image) {
                $name = $image->getClientOriginalName();
                $image->move(public_path() . '/uploads/', $name);
                $data[] = $name;
            }
            $request->merge([
                'images' => $data,
            ]);
        }
        $categories = News::create($request->all());
        return redirect()->route('news.index')->with('create', 'new news is created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('news.update');
        $new = News::findOrFail($id);
        // return $new;
        $communities = Community::get();
        return view('admin.news.edit', [
            'title' => 'Edit The News',
            'new' => $new,
            'communities' => $communities,
        ]);
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

        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'title_gr' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'description_gr' => 'required',
            'community_id' => 'required',
        ]);
        $new = News::findOrFail($id);
        if ($request->hasFile('image')) {
            $file = $request->file('image'); // UplodedFile Object

            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);
            $request->merge([
                'image_url' => $image_path,
            ]);
        }
        if ($request->hasfile('photos')) {
            foreach ($request->file('photos') as $image) {
                $name = $image->getClientOriginalName();
                $image->move(public_path() . '/uploads/', $name);
                $data[] = $name;
            }
            $request->merge([
                'images' => $data,
            ]);
        }
        $new->update($request->all());
        return redirect()->route('news.index')->with('edit', 'the news is updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('news.delete');
        $new = News::findOrFail($id);
        $new->delete();
        return redirect()->route('news.index')->with('delete', 'the news is deletes');
    }
}
