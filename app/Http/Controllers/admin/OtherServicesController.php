<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OtherServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::latest()->paginate(5);
        $title = 'Other Services';
        return view('admin.otherservices.index', ['services' => $services, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create New Services';
        return view('admin.otherservices.create', ['title' => $title]);
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
            'name' => 'required',
            'image' => 'required',
            'description' => 'required',
            'mobile' => 'required|unique:services,mobile',
            'email' => 'required|unique:services,email'
        ]);
        $input = $request->all();
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);

            $input['image'] = $image_path;
        }
        $services = Service::create($input);
        $success = request()->session()->flash('success', 'Service Add successfully');
        return redirect()->route('otherservices.index');
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
        $title = 'Edit  New Service';
        $service = Service::findorfail($id);
        return view('admin.otherservices.edit', [
            'title' => $title,
            'service' => $service,
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

        $services = Service::find($id);
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'mobile' => ['required', Rule::unique('services')->ignore($services->id)],
            'email' => ['required', Rule::unique('services')->ignore($services->id)],
        ]);

        $input = $request->all();
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);

            $input['image'] = $image_path;
        } else {
            $input['image'] = $services->image;
        }
        $services = $services->update($input);
        $success = request()->session()->flash('success', 'Service Updated successfully');
        return redirect()->route('otherservices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();
        return redirect()->back()->with('success', 'service deleted successfully');
    }
}
