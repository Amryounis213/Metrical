<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\UserImport;
use App\Mail\SendPassword;
use App\Models\City;
use App\Models\Community;
use App\Models\ContactWithAdmin;
use App\Models\country;
use App\Models\Enquiry;
use App\Models\Owner;
use App\Models\Property;
use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule as ValidationRule;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function Done($id)
    {
        $user = User::find($id);

        if ($user->need == 'tenant') {
            $property = Property::find($user->tenant->unit_number);
            $property->update([
                'tenant_id' => $user->tenant->id,
            ]);
            $user->update([
                'request_sent' => 0,
            ]);
        }
        if ($user->need == 'owner') {
            $property = Property::find($user->owner->unit_number);
            $property->update([
                'owner_id' => $user->owner->id,
            ]);
            $user->update([
                'request_sent' => 0,
            ]);
        }

        return redirect()->back();
    }



    /* binging users */
    public function index()
    {
        $users = User::where('request_sent', '1')->where('type', '0')->paginate(5);

        return view('admin.users.index', [
            'users' => $users,
            'title' => 'Pending Users'
        ]);
    }

    public function showBindingUser($id)
    {

        $user = User::with('tenant', 'owner', 'Country', 'City')->where('id', $id)->first();
        $enquires = Enquiry::where('user_id', $user->id)->get();
        $contact = ContactWithAdmin::where('user_id', $user->id)->get();
        $history = $enquires->concat($contact);

        return view('admin.users.show', [
            'user' => $user,
            'history' => $history,

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
                $property = Property::find($user->owner->unit_number);
                $property->update([
                    'owner_id' => $owner->id,
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
                $property = Property::find($user->tenant->unit_number);
                $property->update([
                    'tenant_id' => $tenant->id,
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
            $user->update(['request_sent' => 0]);
            $owner = Owner::where('user_id', $user->id)->first() ?? null;
            $owner->delete();
        } else {
            $user->update(['request_sent' => 0]);
            $owner = Tenant::where('user_id', $user->id)->first() ?? null;
            $owner->delete();
        }

        return redirect()->back();
    }

    public function tenants()
    {
        $users = User::with('tenant')->where('type', '2')->paginate(5);
        return view('admin.users.index', [
            'title' => 'All Tenants Here',
            'users' => $users
        ]);
    }
    public function owners()
    {
        $users = User::with('owner')->where('type', '1')->paginate(5);
        return view('admin.users.index', [
            'title' => 'All Owners Here',
            'users' => $users
        ]);
    }


    public function AllUser()
    {
        $users = User::orderBy('created_at', 'DESC')->where('type', '!=', '3')->paginate(5);
        return view('admin.users.index', [
            'title' => 'All Users Here',
            'users' => $users
        ]);
    }


    public function searchFiltering($type)
    {

        $users = User::where('type', $type)
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('admin.users.index', [
            'title' => 'All Users Here',
            'users' => $users
        ]);
    }




    public function storeUser(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'image_url' => 'nullable',
            'email' => 'required|email|unique:users,email',
            'city' => 'required',
            'password' => 'required',
            'mobile_number' => 'required|unique:users,mobile_number',
            'community_id' => [ValidationRule::requiredIf($request->type != '0')],
            'type' => 'required',
            'passport_copy' => [ValidationRule::requiredIf($request->type != '0')],
            'title_dead_copy' => [ValidationRule::requiredIf($request->type == '1')],
            'emirate_id' => 'nullable',
            'unit_number' => 'nullable',
            'property' => [ValidationRule::requiredIf($request->type == '1')],
            'renting_price' => [ValidationRule::requiredIf($request->type == '1')],
            'visa_copy' => [ValidationRule::requiredIf($request->type == '2')]
        ]);


        $str = $request->password;
        try {
            $request->merge([
                'email_verified_at' => Carbon::now(),
                'mobile_number' => $request->phonecode . $request->mobile_number,
                'password' => Hash::make($request->password),
            ]);


            $input = $request->all();

            if ($request->hasFile('image_url')) {
                $file = $request->file('image_url');
                $image_path = $file->store('/', [
                    'disk' => 'upload',
                ]);
                $input['image_url'] = $image_path;
            }

            Mail::to($request->email)->send(new SendPassword($str));

            $users = User::create($input);



            if ($users->type == 1) {
                $owner = new Owner();
                $owner->OwnerAdd($users, $request);
                $owner->update(['type' => 1]);
                return redirect()->route('successlink');
            } elseif ($users->type == 2) {
                $tenant = new Tenant();
                $tenant->TenantAdd($users, $request);
                $tenant->update(['type' => 2]);
                return redirect()->route('successlink');
            } else {
                return redirect()->route('successlink');
            }
        } catch (Exception $exception) {

            return $exception;
        }
    }

    public function addOwnerPage($id)
    {

        $title = 'Link Property with User';
        $properties = Property::get(['id', 'name_en']);
        $owner = Owner::where('user_id', $id)->first();
        $tenant = Tenant::where('user_id', $id)->first();
        return view('admin.users.linkingProperty', [
            'properties' => $properties,
            'title' => $title,
            'id' => $id,
            'owner' => $owner,
            'tenant' => $tenant,
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


    public function filter(Request $request)
    {
        if ($request->type != '4') {
            $users = User::with('tenant', 'owner')
                ->where('type', $request->type)
                ->orwhere('first_name', '%' . $request->name . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate();
        } else {
            $users = User::with('tenant', 'owner')
                ->where('type', '!=', $request->type)
                ->orwhere('first_name', '%' . $request->name . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate();
        }
        return view('admin.users.index', ['users' => $users]);
    }


    public function updateDocs(Request $request)
    {

        if ($request->owner_id) {
            $users = Owner::find($request->owner_id);
        } else if ($request->tenant_id != null) {
            $users = Tenant::find($request->tenant_id);
        } else {
        }


        $input = $request->all();
        if ($request->hasFile('passport_copy')) {

            $uploadedFile = $request->file('passport_copy');

            $passport_copy = $uploadedFile->store('/', 'upload');

            $input['passport_copy'] = $passport_copy;
        }
        if ($request->hasFile('visa_copy')) {
            $uploadedFile = $request->file('visa_copy');
            $visa_copy = $uploadedFile->store('/', 'upload');
            $input['visa_copy'] = $visa_copy;
        }

        if ($request->hasFile('title_dead_copy')) {

            $uploadedFile = $request->file('title_dead_copy');

            $title_dead_copy = $uploadedFile->store('/', 'upload');
            $input['title_dead_copy'] = $title_dead_copy;
        }
        $users->update($input);

        return redirect()->back()->with('success', 'Docs Upload Successfully');
    }

    public function EditUser($id)
    {

        $cities = City::where('country_id', 231)->get(['id', 'name']);
        $communities = Community::get(['id', 'name_en']);
        $user = User::findorfail($id);
        if ($user->owner) {
            $com = $user->owner->community_id;
        } elseif ($user->tenant) {
            $com = $user->tenant->community_id;
        } else {
            $com = '';
        }
        return view('admin.users.edituser', [
            'user' => $user,
            'cities' => $cities,
            'communities' => $communities,
            'countries2' => country::select('id', 'name')->get(),
            'country' => country::select('id', 'name')->get(),
            'title' => 'Edit User Profile',
            'com' => $com,
            //'phonecode' => country::select('phonecode')->get(),
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function UpdateUserInfo(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'image_url' => 'nullable',
            'email' => 'required',
            'city' => 'required',
            'mobile_number' => 'required',

        ]);

        if ($request->password) {
            $request->merge([
                'password' => Hash::make($request->password),
            ]);
        }
        $input = $request->all();
        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);
            $input['image_url'] = $image_path;
        }

        $user = User::find($id);

        $user->update($input);
        if ($user->type == 1) {
            $owner = Owner::where('user_id', $user->id)->first();
            $owner->update([

                'full_name' => $user->first_name . ' ' . $user->last_name,
                'email' => $user->email,
                'mobile' => $user->mobile_number
            ]);
            return redirect()->route('binding.show', $user->id)->with('success', 'Update User info Successfully');
        } elseif ($user->type == 2) {
            $tenant = Tenant::where('user_id', $user->id)->first();
            $tenant->update([

                'full_name' => $user->first_name . ' ' . $user->last_name,
                'email' => $user->email,
                'mobile' => $user->mobile_number
            ]);
            return redirect()->route('binding.show', $user->id)->with('success', 'Update User info Successfully');
        } else {
            return redirect()->route('binding.show', $user->id)->with('success', 'Update User info Successfully');
        }
    }



    public function import(Request $request)
    {

        /* $this->validate($request, [
            'excel'  => 'required|mimes:xls,xlsx'
        ]);*/

        $path = $request->file('excel');
        Excel::import(new UserImport, $path);

        return redirect()->back()->with('success', 'Users Added Successfully');
    }

    public function importCsvView()
    {
        return view('admin.users.uploadcsv');
    }
}
