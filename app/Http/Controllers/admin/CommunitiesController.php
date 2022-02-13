<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Searchable\Search;

class CommunitiesController extends Controller
{
    public function result(Request $request)
    {
        dd($request->name);
        $communities = Community::where('name_en', 'LIKE', '%' . $request->name . '%')->get();

        return view('admin.communities.result', [
            'communities' => $communities,
            'title' => 'Show All Results'
        ]);
    }
    public function index()
    {
        $communities = Community::withCount('properties')->get();
        return view('admin.communities.index', [
            'communities' => $communities,
            'title' => 'Show All Communities'
        ]);
    }
    public function create()
    {
        Gate::authorize('communities.create');
        $community = new Community();
        return view('admin.communities.create', [
            'community' => $community,
            'title' => 'Create New Community'
        ]);
    }

    public function store(Request $request)
    {


        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'name_gr' => 'required',
            'area' => 'required',
            'address_ar' => 'required',
            'address_en' => 'required',
            'address_gr' => 'required',
            'image_url' => 'required',
            'status' => 'required',
            'readness_percentage' => 'required|min:0|max:100',
        ]);

        $input = $request->all();
        if ($request->hasFile('image_url')) {

            $file = $request->file('image_url');
            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);

            $input['image'] = $image_path;
        }
        $community = Community::create($input);
        return redirect(route('communities.index'));
    }

    public function show($id)
    {


        $community = Community::findOrFail($id);
        return $community;
        // $response = Http::get('http://www.geoplugin.net/extras/forward_place.gp?place=Sohag&country=EG');
        // return unserialize($response)[0];
    }
    public function edit($id)
    {
        Gate::authorize('communities.update');
        $community = Community::findOrFail($id);
        return view('admin.communities.edit', [
            'community' => $community,
            'title' => 'Edit The Community'
        ]);
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'name_gr' => 'required',
            'area' => 'required',
            'address_ar' => 'required',
            'address_en' => 'required',
            'address_gr' => 'required',
            //'image' => 'required',
            'status' => 'required',
            'readness_percentage' => 'required|min:0|max:100',
        ]);
        $community = Community::findOrFail($id);

        $input = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);

            $input['image'] = $image_path;
        }

        $community->update($input);
        return redirect(route('communities.index'));
    }
    public function destroy($id)
    {
        // dd(Community::findOrFail($id)->properties()->count());
        Gate::authorize('communities.delete');
        if (Community::findOrFail($id)->properties()->count() > 0) {
            return redirect()->back()->with('primary', 'the community has more one properties (You cannot delete)');
        }
        $community = Community::findOrFail($id);
        $community->delete();
        return redirect(route('communities.index'));
    }

    public function showPropertiesByCommunity($id)
    {
        $title = 'All Properties';
        $properties = Property::with(['community', 'owner', 'rent' => function ($query) {
            $query->where('status', 'active');
        }])->where('community_id', $id)->paginate(6);
        $tenants = User::with('tenant')->where('type', '3')->orWhere('type', '2')->get();
        $owners = User::with('owner')->where('type', '3')->orWhere('type', '1')->get();
        return view('admin.properties.index', [
            'properties' => $properties,
            'percentage' => 0,
            'title' => $title,
            'tenants' => $tenants,
            'owners' => $owners,
            'id' => $id,
        ]);
    }
}
