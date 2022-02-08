<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProperysExport;
use App\Http\Controllers\Controller;
use App\Imports\ProperysImport;
use App\Models\Amenity;
use App\Models\Community;
use App\Models\Owner;
use App\Models\Property;
use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function result(Request $request)
    {

        $properties = Property::where('name_en', 'LIKE', '%' . $request->name . '%')->paginate(10);
        $percentage = Property::Percentage() ?? 0;
        $tenants = User::with('tenant')->where('type', '3')->orWhere('type', '2')->get();
        $owners = User::with('owner')->where('type', '3')->orWhere('type', '1')->get();
        return view('admin.properties.index', [
            'properties' => $properties,
            'percentage' => $percentage,
            'tenants' => $tenants,
            'owners' => $owners,
            'title' => 'Properties Results'
        ]);
    }
    public function index()
    {

        //Gate::authorize('properties.view');

        $properties = Property::with(['community', 'owner', 'tenant', 'rent' => function ($query) {
            $query->where('status', 'active');
        }])
            ->orderBy('created_at', 'DESC')
            ->paginate(6);



        $percentage = Property::Percentage() ?? 0;
        $tenants = User::with('tenant')->where('type', '3')->orWhere('type', '2')->get();
        $owners = User::with('owner')->where('type', '3')->orWhere('type', '1')->get();



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
        Gate::authorize('properties.addowner');
        $properties = Property::findORFail($request->property_id);
        // return $properties;
        $properties->update([
            'owner_id' => $request->owner_id,
            'ownership_date' => Carbon::now(),
            'offer_type' => 'stop',
        ]);

        return back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        Gate::authorize('properties.create');

        $title = 'Create New Property';
        $property = new Property();
        $amenities = Amenity::all();
        //  $communities = Community::get();

        return view('admin.properties.create', [
            'title' => $title,
            'property' => $property,
            'amenities' => $amenities,
            'communities' => Community::get(),
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
            'name_en' => 'required',
            'name_ar' => 'required',
            'name_gr' => 'required',
            'image_url' => 'nullable',
            'images' => 'nullable|max:10240',
            'community_id' => 'required|exists:communities,id',
            'description_ar' => 'nullable',
            'description_ar' => 'nullable',
            'description_ar' => 'nullable',
            'address_ar' => 'nullable',
            'address_en' => 'nullable',
            'address_gr' => 'nullable',
            'area' => 'required',
            'feminizations' => 'nullable',
            'bedroom' => 'required',
            'bathroom' => 'required',
            'status' => 'required',
            'is_shortterm' => 'required',
            'offer_type' => 'required',
            'type' => 'required',
            'gate' => 'required',
            'amenities' => 'nullable',
            'reference' => 'required'
        ]);
        $address = Community::find($request->community_id);



        $request->merge([
            'date_added' => Carbon::now(),
            'address_ar' => $address->address_ar ?? 'UAE',
            'address_en' => $address->address_en ?? 'UAE',
            'address_gr' => $address->address_gr ?? 'UAE',
            'location_latitude' => $address->location_latitude,
            'location_longitude' => $address->location_longitude,
            'feminizations' => 'no',
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
        Gate::authorize('properties.update');

        $title = 'Edit Property';
        $property = Property::find($id);
        $communities = Community::all();
        $amenities = Amenity::all();

        return view('admin.properties.edit', [
            'property' => $property,
            'title' => $title,
            'amenities' => $amenities,
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
            'name_en' => 'required',
            'name_ar' => 'required',
            'name_gr' => 'required',
            'image_url' => 'nullable',
            'images' => 'nullable|max:10240',
            'community_id' => 'required|exists:communities,id',
            'description_ar' => 'nullable',
            'description_ar' => 'nullable',
            'description_ar' => 'nullable',
            'address_ar' => 'nullable',
            'address_en' => 'nullable',
            'address_gr' => 'nullable',
            'area' => 'required',
            'feminizations' => 'nullable',
            'bedroom' => 'required',
            'bathroom' => 'required',
            'status' => 'required',
            'is_shortterm' => 'required',
            'offer_type' => 'required',
            'type' => 'required',
            'gate' => 'required',
            'amenities' => 'nullable',
            'reference' => 'required'
        ]);


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
        Gate::authorize('properties.delete');

        $property = Property::find($id);
        $property->delete();
        return redirect()->back();
    }

    public function import(Request $request)
    {

        /* $this->validate($request, [
            'excel'  => 'required|mimes:xls,xlsx'
        ]);*/

        $path = $request->file('excel');
        Excel::import(new ProperysImport, $path);

        return redirect()->back()->with('success', 'Properties Add Successfully');
    }

    public function importCsvView()
    {
        return view('admin.properties.uploadcsv');
    }




    public function Filter(Request $request)
    {


        $properties = Property::with(['community', 'owner', 'tenant', 'rent' => function ($query) {
            $query->where('status', 'active');
        }])->when($request->offerBy, function ($query) use ($request) {
            $query->where('offer_type', $request->offerBy);
        })->when($request->type, function ($query) use ($request) {
            $query->where('type', $request->type);
        })->when($request->status, function ($query) use ($request) {
            if ($request->status == 'owned') {
                $query->where('owner_id', '!=', null);
            }
            if ($request->status == 'rented') {
                $query->where('tenant_id', '!=', null);
            }
            if ($request->status == 'notowned') {
                $query->where('owner_id',  null);
            }

            if ($request->status == 'notrented') {
                $query->where('tenant_id',  null);
            }
        })
            ->paginate(10);


        $tenants = User::with('tenant')->where('type', '3')->orWhere('type', '2')->get();
        $owners = User::with('owner')->where('type', '3')->orWhere('type', '1')->get();
        $percentage = Property::Percentage() ?? 0;
        return view('admin.properties.index', [
            'properties' => $properties,
            'percentage' => $percentage,
            'properties_count' => $properties->count(),
            'tenants' => $tenants,
            'owners' => $owners
        ]);
    }

    public function addPropertyByCommunity($id)
    {
        $title = 'Create New Property';
        $amenities = Amenity::all();

        $property = new Property();
        return view(
            'admin.properties.create',
            [
                'title' => $title,
                'property' => $property,
                'amenities' => $amenities,
                'community' => Community::where('id', $id)->first(),
            ]
        );
    }
}
