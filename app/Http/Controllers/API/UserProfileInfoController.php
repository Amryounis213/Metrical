<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Tenant;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileInfoController extends Controller
{
    // for personal info
    public function showPersonalProfile()
    {
        $profile = Auth::guard('sanctum')->user([
            'first_name', 'last_name', 'email ', 'mobile_number', 'id_number', 'nationality', 'country', 'city'
        ]);
        return [
            'status' => 200,
            'message' => __('the profile of user'),
            'data' => $profile,
        ];
    }
    // for personal info
    public function editPersonalProfile(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $request->validate([
            'email' => 'required',
            'country' => 'required',
            'city' => 'required',
            'mobile_number' => 'required',
            'nationality' => 'required',
            'id_number' => 'required',

        ]);
        if ($request->hasFile('image')) {
            if ($user->image_url !== null) {

                unlink(public_path('upload/' . $user->image_url));
            }
            $uploadedFile = $request->file('image');

            $image_url = $uploadedFile->store('/', 'upload');
            $request->merge([
                'image_url' => $image_url
            ]);
        }

        $user->update($request->all());
        return  response()->json(
            [
                'status' => '201',
                'message' => __('the profile was updated'),
                'data' => Auth::guard('sanctum')->user()
            ],
            201
        );
    }

    // for Family info
    public function showFamilyProfile()
    {
        $profile = Auth::guard('sanctum')->user([
            'children_number', 'adults_number', 'member_family_number'
        ]);
        return [
            'status' => 200,
            'message' => __('the profile of user'),
            'data' => $profile,
        ];
    }

    // edit Family info
    public function editFamilyProfile(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $request->validate([
            'children_number' => 'required',
            'adults_number' => 'required',
            'member_family_number' => 'required'
        ]);
        $user->update($request->all());
        return  response()->json(
            [
                'status' => '201',
                'message' => __('the profile was updated'),
                'data' => Auth::guard('sanctum')->user()
            ],
            201
        );
    }


    // edit Docs info
    public function editDocsProfile(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $request->validate([
            'contracts_copy' => 'required',
            'contract_expiry' => 'required',
            'title_deed_copy' => ' required',
            'emirates_id_copy' => ' required',
            'passport_copy_image' => ' required',
            'passport_expiry_date' => ' required',
        ]);
        if ($request->hasFile('contracts_copy')) {
            if ($user->contracts !== null) {

                unlink(public_path('upload/' . $user->contracts));
            }
            $uploadedFile = $request->file('contracts_copy');

            $contracts = $uploadedFile->store('/', 'upload');
            $request->merge([
                'contracts' => $contracts
            ]);
        }
        if ($request->hasFile('title_deed_copy')) {
            if ($user->title_deed !== null) {

                unlink(public_path('upload/' . $user->title_deed));
            }
            $uploadedFile = $request->file('title_deed_copy');

            $title_deed = $uploadedFile->store('/', 'upload');
            $request->merge([
                'title_deed' => $title_deed,
                'title_dead_copy' => $title_deed
            ]);
        }
        if ($request->hasFile('emirates_id_copy')) {
            if ($user->emirates_id !== null) {

                unlink(public_path('upload/' . $user->emirates_id));
            }
            $uploadedFile = $request->file('emirates_id_copy');

            $emirates_id = $uploadedFile->store('/', 'upload');
            $request->merge([
                'emirates_id' => $emirates_id
            ]);
        }
        if ($request->hasFile('passport_copy_image')) {
            if ($user->passport_copy !== null) {

                unlink(public_path('upload/' . $user->passport_copy));
            }
            $uploadedFile = $request->file('passport_copy_image');

            $passport_copy = $uploadedFile->store('/', 'upload');
            $request->merge([
                'passport_copy' => $passport_copy
            ]);
        }
        $request->merge([
            'user_id' => $user->id
        ]);
        if ($user->type == 1) {

            $owner = Owner::where('user_id', $user->id)->first();

            $owner->update($request->all());
        } else if ($user->type == 2) {
            $tenant = Tenant::where('user_id', $user->id)->first();
            $tenant->update($request->all());
        }
        UserProfile::create($request->all());
        return  response()->json(
            [
                'status' => '201',
                'message' => __('the profile was updated'),
                'data' => $user
            ],
            201
        );
    }

    public function ShowEmergencyContacts()
    {
        $user = Auth::guard('sanctum')->user();
        return  response()->json(
            [
                'status' => '201',
                'message' => __('Emergancy Contacts'),
                'data' => $user->EmergencyContacts()->get(),
            ],
            201
        );
    }
    public function AddEmergencyContacts(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $request->validate([
            'full_name' => 'required',
            'mobile' => 'required',
            'country' => 'required',

        ]);
        $contact  = $user->EmergencyContacts->create($request->all());
        return  response()->json(
            [
                'status' => '201',
                'message' => __('Emergancy Contacts'),
                'data' => $user
            ],
            201
        );
    }
}
