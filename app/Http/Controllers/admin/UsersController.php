<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Community;
use App\Models\country;
use App\Models\Owner;
use App\Models\Property;
use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /* binging users */
    public function index()
    {
        $users = User::where('request_sent', '1')->where('type', '0')->get();

        return view('admin.users.index', [
            'users' => $users,
            'title' => 'Pending Users'
        ]);
    }

    public function showBindingUser($id)
    {

        $user = User::with('tenant', 'owner')->where('id', $id)->first();
        dd($user->owner);
        return view('admin.users.show', [
            'user' => $user
        ]);
    }

    public function acceptBinding($id)
    {

        $user = User::findOrFail($id);
        if ($user->need == 'owner') {
            $owner = Owner::where('user_id', $user->id)->first() ?? null;
            if ($owner != null) {
                $user->update([
                    'request_sent' => '0',
                    'type' => '1',
                ]);

                $owner->update(['status' => '1']);
            }
        } else {

            $tenant = Tenant::where('user_id', $user->id)->first() ?? null;
            if ($tenant != null) {
                $user->update([
                    'request_sent' => '0',
                    'type' => '2',
                ]);
                $tenant->update(['status' => '1']);
            }
        }




        $success = session()->flash('success', 'The user was Accepted');
        return redirect()->route('binding.users');
    }

    public function refuseBinding(Request $request, $id)
    {
        Gate::authorize('pending.accept');

        $user = User::findOrFail($id);

        if ($user->need == 'owner') {

            $owner = Owner::where('user_id', $user->id)->first() ?? null;
            $owner->delete();
        } else {
            $owner = Tenant::where('user_id', $user->id)->first() ?? null;
            $owner->delete();
        }



        return redirect()->route('binding.users');
    }

    public function tenants()
    {
        $users = User::with('tenant')->where('type', '2')->get();
        return view('admin.users.index', [
            'title' => 'All Tenants Here',
            'users' => $users
        ]);
    }
    public function owners()
    {
        $users = User::with('owner')->where('type', '1')->get();
        return view('admin.users.index', [
            'title' => 'All Owners Here',
            'users' => $users
        ]);
    }


    public function AllUser()
    {
        $users = User::orderBy('first_name', 'ASC')->paginate(5);
        return view('admin.users.index', [
            'title' => 'All Users Here',
            'users' => $users
        ]);
    }


    public function searchFiltering($type)
    {

        $users = User::where('type', $type)->get();
        return view('admin.users.index', [
            'title' => 'All Users Here',
            'users' => $users
        ]);
    }

    public function createUser()
    {
        $title = 'Create New Users';
        //$users = User::create($request->all());
        $countries = country::get(['id', 'name']);
        $cities = City::get(['id', 'name']);
        $communities = Community::get(['id', 'name_en']);
        return view('admin.users.create', [
            'title' => $title,
            'countries' => $countries,
            'cities' => $cities,
            'communities' => $communities,
        ]);
    }

    public function storeUser(Request $request)
    {


        try {
            $request->merge([
                'password' => Hash::make($request->password),
                'email_verified_at' => Carbon::now(),
            ]);
            $users = User::create($request->all());

            if ($users->type == 1) {
                $owner = new Owner();
                $owner->OwnerAdd($users, $request);
            }
            return redirect()->route('props', $users->id);
        } catch (Exception $exception) {

            return $exception;
        }
    }

    public function addOwnerPage($id)
    {

        $title = 'Link Property with User';
        $properties = Property::get(['id', 'name_en']);
        $owner = Owner::where('user_id', $id)->first();
        return view('admin.users.linkingProperty', [
            'properties' => $properties,
            'title' => $title,
            'id' => $id,
            'owner' => $owner,
        ]);
    }



    public function addOwner(Request $request)
    {

        // Gate::authorize('properties.addowner');
        $properties = Property::where('id', $request->property_id)->first();

        $properties->update([
            'owner_id' => $request->owner_id,
            'ownership_date' => Carbon::now(),
            'offer_type' => 'stop',
        ]);

        return redirect()->route('successlink');
    }



    public function successLink()
    {
        return view('admin.users.successpage');
    }
}
