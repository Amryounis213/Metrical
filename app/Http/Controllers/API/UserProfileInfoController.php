<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\EmergencyContact;
use App\Models\Owner;
use App\Models\Tenant;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $validation = Validator::make($request->all(), [
            'email' => ['required', Rule::unique('users')->ignore(Auth::guard('sanctum')->id())],
            'country' => 'nullable',
            'city' => 'nullable',
            'mobile_number' => ['required', Rule::unique('users')->ignore(Auth::guard('sanctum')->id())],
            'nationality' => 'nullable',
            'id_number' => 'nullable',
            'first_name' => 'required',
            'last_name' => 'required',


        ]);
        if ($validation->fails()) {
            return  response()->json([
                'status' => false,
                'code' => 422,
                'message' => '',
                'data' => $validation->errors(),
            ], 422);
        }
        $user = User::where('id', Auth::guard('sanctum')->id())->first();
        // $user = Auth::guard('sanctum')->user();
        if ($request->hasFile('image')) {
            if ($user->image_url !== null) {

                unlink(public_path('uploads/' . $user->image_url));
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
                'status' => true,
                'code' => 201,
                'message' => 'Profile Updated Succesfully',
                'data' => $user,
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
            'status' => true,
            'code' => 200,
            'message' => __('the profile of user'),
            'data' => $profile,
        ];
    }

    // edit Family info
    public function editFamilyProfile(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $request->validate([
            'children_number' => 'nullable',
            'adults_number' => 'nullable',
            'member_family_number' => 'nullable'
        ]);
        $user->update($request->all());
        return  response()->json(
            [
                'status' => true,
                'code' => 201,
                'message' => __('the profile was updated'),
                'data' => Auth::guard('sanctum')->user()
            ],
            201
        );
    }


    // edit Docs info
    public function editDocsProfile(Request $request)
    {
        $docs = UserProfile::where('user_id', Auth::guard('sanctum')->id())->first();
        if (!$docs) {
            UserProfile::create([
                'user_id' => Auth::guard('sanctum')->id()
            ]);
            $docs = UserProfile::where('user_id', Auth::guard('sanctum')->id())->first();
        }
        $user = Auth::guard('sanctum')->user();
        $request->validate([
            'contracts_copy' => 'nullable',
            'contract_expiry' => 'nullable',
            'title_deed_copy' => ' nullable',
            'emirates_id_copy' => ' nullable',
            'passport_copy_image' => ' nullable',
            'passport_expiry_date' => ' nullable',
        ]);
        if ($request->hasFile('contracts_copy')) {
            if ($user->contracts !== null) {

                unlink(public_path('upload/' . $user->contracts));
            }
            $uploadedFile = $request->file('contracts_copy');

            $contracts = $uploadedFile->store('/', 'upload');
            $request->merge([
                'contracts' => asset('upload/' . $contracts),
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
                'emirates_id' => asset('upload/' . $emirates_id),

            ]);
        }
        if ($request->hasFile('passport_copy_image')) {
            if ($user->passport_copy !== null) {

                unlink(public_path('upload/' . $user->passport_copy));
            }
            $uploadedFile = $request->file('passport_copy_image');

            $passport_copy = $uploadedFile->store('/', 'upload');
            $docs->update([
                'passport' => $passport_copy,
            ]);
            $request->merge([
                'passport_copy' => asset('upload/' . $passport_copy),
            ]);
        }
        if ($request->passport_expiry_date) {
            $docs->update([
                'passport_expiry' => $request->passport_expiry_date
            ]);
        }
        $request->merge([
            'user_id' => $user->id
        ]);
        if ($user->type == 1) {

            $owner = Owner::where('user_id', Auth::guard('sanctum')->id())->first();
            $owner->update($request->all());
        } else if ($user->type == 2) {
            $tenant = Tenant::where('user_id', $user->id)->first();
            $tenant->update($request->all());
        }
        if (!$docs) {
            UserProfile::create($request->all());
        } else {
            $docs->update($request->all());
        }
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
            'name' => 'required',
            'mobile' => 'required',
            'country' => 'required',

        ]);
        $request->merge([
            'user_id' => Auth::guard('sanctum')->id(),
        ]);
        $contact  = EmergencyContact::create($request->all());
        return  response()->json(
            [
                'status' => '201',
                'message' => __('Emergancy Contacts'),
                'data' => $contact,
            ],
            201
        );
    }

    public function EditEmergencyContacts(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'country' => 'required',
            'country2' => [Rule::requiredIf($request->name2 != null)],
            'name2' => [Rule::requiredIf($request->country2 != null)],
            'mobile2' => [Rule::requiredIf($request->name2 != null)],
        ]);
        $request->merge([
            'user_id' => Auth::guard('sanctum')->id(),
        ]);
        $emergancy = EmergencyContact::where('user_id', Auth::guard('sanctum')->id())->get();
        if ($emergancy->count() <= 0) {
            //Add : IF NO HAVE ANY EC 
            $e = EmergencyContact::create([
                'user_id' => Auth::guard('sanctum')->id(),
                'country' => $request->country,
                'name' => $request->name,
                'mobile' => $request->mobile,
            ]);

            //enable add 2 EC To DB
            if ($request->country2) {
                $ee = EmergencyContact::create([
                    'user_id' => Auth::guard('sanctum')->id(),
                    'country' => $request->country2,
                    'name' => $request->name2,
                    'mobile' => $request->mobile2,
                ]);
            }
            //Return array 
            if ($request->country2) {
                $arr = [$e, ($ee ?? null)];
            } else {
                $arr = [$e];
            }
        } else {
            //GET EM 1 for user 
            $e = EmergencyContact::find($emergancy[0]->id);
            $e->update([
                'user_id' => Auth::guard('sanctum')->id(),
                'country' => $request->country,
                'name' => $request->name,
                'mobile' => $request->mobile,
            ]);


            if ($emergancy->count() > 1) {
                // $check = EmergencyContact::where('id', $emergancy[1]->id)->exists();
                if ($request->country2) {
                    $ee = $emergancy[1]->update([
                        'user_id' => Auth::guard('sanctum')->id(),
                        'country' => $request->country2,
                        'name' => $request->name2,
                        'mobile' => $request->mobile2,
                    ]);
                }
            } else {

                if ($request->country2) {
                    $ee = EmergencyContact::create([
                        'user_id' => Auth::guard('sanctum')->id(),
                        'country' => $request->country2,
                        'name' => $request->name2,
                        'mobile' => $request->mobile2,
                    ]);
                }
            }

            //   return $check = $ee;
            /*  $em = EmergencyContact::where('user_id', Auth::guard('sanctum')->id())->get();
            if ($em->count() > 1) {
                $ee = EmergencyContact::find($emergancy[1]->id);
                $ee->update([
                    'country' => $request->country2,
                    'name' => $request->name2,
                    'mobile' => $request->mobile2,
                ]);
            }*/

            $res = EmergencyContact::where('user_id', Auth::guard('sanctum')->id())->get();
            $cc = $res->count() > 1;
            if ($cc) {
                $arr = [$e, $res[1]];
            } else {
                $arr = [$e];
            }
        }







        return  response()->json(
            [

                'status' => true,
                'code' => 201,
                'message' => __('Emergancy Contacts'),
                'data' => $arr,
            ],
            201
        );
    }
}
