<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Owner;
use App\Models\Property;
use App\Models\Tenant;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        $properties = Property::with(['community', 'owner', 'rent' => function ($query) {
            $query->where('status', 'active');
        }])->get();

        $percentage = Property::Percentage() ?? 0;
        $tenants = Tenant::get();
        $owners = Owner::get();
        // return $owners[0]->user;
        return view('admin.properties.index', [
            'properties' => $properties,
            'percentage' => $percentage,
            'properties_count' => Property::count(),
            'tenants' => $tenants,
            'owners' => $owners
        ]);
    }
    // add Owner Mohammed

    public function addOwner(Request $request)
    {
        // return $request;
        $properties = Property::findORFail($request->property_id);
        // return $properties;
        $properties->update(['owner_id' => $request->owner_id]);
        
        return back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create New Property';
        $property = new Property();
        $amenities = Amenity::all();
        return view('admin.properties.create', [
            'title' => $title,
            'property' => $property,
            'amenities' => $amenities
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


        $request->merge([
            'date_added' => Carbon::now(),
            'community_id' => 1,
        ]);
        $input = $request->all();
        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);
            $input['image_url'] = $image_path;
        }


        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $image) {
                $name = $image->store('uploads', 'public');
                $data[] = $name;
            }
            $input['images'] = $data;
        }

        $isSaved = Property::create($input);
        if ($isSaved) {
            return redirect()->route('properties.index');
        }
        return redirect()->back();
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
        $title = 'Edit Property';
        $property = Property::find($id);
        $amenities = Amenity::all();
        return view('admin.properties.edit', ['property' => $property, 'title' => $title, 'amenities' => $amenities]);
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
        $property = Property::findOrfail($id);

        $input = $request->all();
        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);
            $input['image_url'] = $image_path;
        }

        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $image) {
                $name = $image->store('uploads', 'public');
                $data[] = $name;
            }
            $input['images'] = $data;
        }
        $isUpdated = $property->update($input);
        if ($isUpdated) {
            return redirect()->route('properties.index');
        }
        return redirect()->back();
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
}
