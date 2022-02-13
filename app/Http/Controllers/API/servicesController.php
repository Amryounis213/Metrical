<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DeliveryPermit;
use App\Models\MoveIn;
use App\Models\MoveOut;
use App\Models\Owner;
use App\Models\Tenant;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\WorkPermit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class servicesController extends Controller
{




    public function moveIn(Request $request)
    {


        $validation = Validator::make($request->all(), [
            'full_name' => 'required',
            'country' => 'required',
            'email' => 'required',
            'aduls' => 'required',
            'nationalty' => 'required',
            'mobile' => 'required',
            'children' => 'nullable',
            'emirate_id' => 'nullable',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'contact' => 'required',
            'property_id' => 'required|exists:properties,id',
            'tenancy_contract' => 'nullable',
            'contract_expiry' => 'nullable',
            'passport' => 'nullable',
            'passport_expiry' => 'nullable',
            'title_dead' => 'nullable',
            'emirateId_image' => 'nullable',
        ]);

        if ($validation->fails()) {
            return  response()->json([
                'status' => false,
                'code' => 422,
                'message' => '',
                'data' => $validation->errors(),
            ], 422);
        }

        $passport_number = User::find(Auth::guard('sanctum')->id())->passport_number ?? null;
        $own = Owner::where('user_id', Auth::guard('sanctum')->id())->first();
        $passport_expiry_dateO = $own->passport_expiry_date ?? null;
        $passportO = $own->passport_copy ?? null;
        $ten = Tenant::where('user_id', Auth::guard('sanctum')->id())->first();
        $passport_expiry_dateT = $ten->passport_expiry_date ?? null;
        $passportT = $ten->passport_copy ?? null;
        $docs = UserProfile::where('user_id', Auth::guard('sanctum')->id())->first();

        //    $passport = $docs->passport;
        if (!$docs) {
            UserProfile::create([
                'user_id' => Auth::guard('sanctum')->id(),
                'contract_expiry' => $request->contract_expiry ?? null,
            ]);

            $docs = UserProfile::where('user_id', Auth::guard('sanctum')->id())->first();
        } else {
            $docs->update([
                'contract_expiry' => $request->contract_expiry,
            ]);
        }

        $request->merge([
            'user_id' => Auth::guard('sanctum')->id(),
            'passport_number' => $request->passport_number ?? $passport_number,
            'passport_expiry' => $request->passport_expiry ?? $docs->passport_expiry,
            //  'passport_expiry' => $passport_expiry_dateO ?? $passport_expiry_dateT,
            'emirateId_image' => $docs->emirates_id ?? null,
            'passport' => $passportO ?? $passportT,
            'contract_expiry' => $request->contract_expiry ?? null,
        ]);



        if ($request->passport_number) {
            $us = User::find(Auth::guard('sanctum')->id());
            $us->update([
                'passport_number' => $request->passport_number,
            ]);
        }
        if ($request->passport) {
            $us = User::find(Auth::guard('sanctum')->id());
            if ($us->type == 1) {
                $owner = Owner::where('user_id', Auth::guard('sanctum')->id())->first();
                $owner->update([
                    'passport_copy' => $request->passport,
                ]);
                $docs->update([
                    'passport' => $request->passport,
                ]);
            }
            if ($us->type == 2) {
                $tenant = Tenant::where('user_id', Auth::guard('sanctum')->id())->first();
                $tenant->update([
                    'passport_copy' => $request->passport,
                ]);
            }
        }

        if ($request->passport_expiry) {
            $us = User::find(Auth::guard('sanctum')->id());
            if ($us->type == 1) {
                $p = Owner::where('user_id', Auth::guard('sanctum')->id())->first();
                $p->update([
                    'passport_expiry_date' => $request->passport_expiry,
                ]);
            }

            if ($us->type == 2) {
                $p = Tenant::where('user_id', Auth::guard('sanctum')->id())->first();
                $p->update([
                    'passport_expiry_date' => $request->passport_expiry,
                ]);
            }

            $docs->update([
                'passport_expiry' => $request->passport_expiry,
            ]);
        }


        $input = $request->all();
        $input['passport'] = $docs->passport;
        if ($request->hasFile('passport')) {
            $file = $request->file('passport'); // UplodedFile Object
            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);

            $input['passport'] = $image_path;


            $docs->update([
                'passport' => $image_path,
            ]);
        }
        if ($request->hasFile('title_dead')) {
            $file = $request->file('title_dead'); // UplodedFile Object

            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);
            $request->merge([
                'title_dead' => $image_path,
            ]);
            $input['title_dead'] = $image_path;

            $docs->update([
                'title_deed' => $image_path,
            ]);
        }

        if ($request->hasFile('emirateId_image')) {
            $file = $request->file('emirateId_image'); // UplodedFile Object

            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);
            $request->merge([
                'emirateId_image' => $image_path,
            ]);
            $input['emirateId_image'] = $image_path;
            $docs->update([
                'emirates_id' => $image_path,
            ]);
        }

        if ($request->hasFile('tenancy_contract')) {
            $file = $request->file('tenancy_contract'); // UplodedFile Object

            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);
            $request->merge([
                'tenancy_contract' => $image_path,
            ]);
            $input['tenancy_contract'] = $image_path;
            $docs->update([
                'contracts' => $image_path,
            ]);
        }

        $moveIn = MoveIn::create($input);

        return response()->json([
            'status' => true,
            'code' => 201,
            'message' => __('messages.Enquiry'),
            'data' => $moveIn,
        ]);
    }


    public function moveOut(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'full_name' => 'required| string',
            'country' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'property_id' => 'required|exists:properties,id'
        ]);

        if ($validation->fails()) {
            return  response()->json([
                'status' => false,
                'code' => 422,
                'message' => '',
                'data' => $validation->errors(),
            ], 422);
        }


        $request->merge([
            'user_id' => Auth::guard('sanctum')->id(),
        ]);

        $moveOut = MoveOut::create($request->all());

        return response()->json([
            'status' => true,
            'code' => 201,
            'message' => __('messages.Enquiry'),
            'data' => $moveOut,
        ]);
    }


    public function workPermit(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'contractor_name' => 'required',
            'contractor_contact_name' => 'required',
            'country' => 'required',
            'mobile' => 'required',
            'number_of_staff' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',


            'resident_name' => 'required',
            'resident_country' => 'required',
            'children_number' => 'nullable',
            'aduls' => 'required',
            'resident_mobile' => 'required',


            'officer_number' => 'required',
            'emirate_id' => 'nullable',
            'date' => 'required',
            'contact' => 'required',
            'property_id' => 'required|exists:properties,id',

            'tenancy_contract' => 'nullable',
            'contract_expiry' => 'nullable',
            'passport' => 'nullable',
            'passport_expiry' => 'nullable',
            'title_dead' => 'nullable',
            'emirateId_image' => 'nullable',
        ]);

        if ($validation->fails()) {
            return  response()->json([
                'status' => false,
                'code' => 422,
                'message' => '',
                'data' => $validation->errors(),
            ], 422);
        }
        $passport_number = User::find(Auth::guard('sanctum')->id())->passport_number ?? null;
        $own = Owner::where('user_id', Auth::guard('sanctum')->id())->first();
        $passport_expiry_dateO = $own->passport_expiry_date ?? null;
        $passportO = $own->passport_copy ?? null;
        $ten = Tenant::where('user_id', Auth::guard('sanctum')->id())->first();
        $passport_expiry_dateT = $ten->passport_expiry_date ?? null;
        $passportT = $ten->passport_copy ?? null;
        $docs = UserProfile::where('user_id', Auth::guard('sanctum')->id())->first();
        if (!$docs) {
            UserProfile::create([
                'user_id' => Auth::guard('sanctum')->id(),
            ]);

            $docs = UserProfile::where('user_id', Auth::guard('sanctum')->id())->first();
        } else {
            $docs->update([
                'contract_expiry' => $request->contract_expiry,
            ]);
        }

        $request->merge([
            'user_id' => Auth::guard('sanctum')->id(),
            'passport_number' => $request->passport_number ?? $passport_number,
            'passport_expiry' => $request->passport_expiry ?? $docs->passport_expiry,

            'emirateId_image' => $docs->emirates_id ?? null,
            'passport' => $passportO ?? $passportT,
            'contract_expiry' => $request->contract_expiry ?? null,
        ]);

        if ($request->passport_number) {
            $us = User::find(Auth::guard('sanctum')->id());
            $us->update([
                'passport_number' => $request->passport_number,
            ]);
        }
        if ($request->passport) {
            $us = User::find(Auth::guard('sanctum')->id());
            if ($us->type == 1) {
                $owner = Owner::where('user_id', Auth::guard('sanctum')->id())->first();
                $owner->update([
                    'passport_copy' => $request->passport,
                ]);
                $docs->update([
                    'passport' => $request->passport,
                ]);
            }
            if ($us->type == 2) {
                $tenant = Tenant::where('user_id', Auth::guard('sanctum')->id())->first();
                $tenant->update([
                    'passport_copy' => $request->passport,
                ]);
            }
        }

        if ($request->passport_expiry) {
            $us = User::find(Auth::guard('sanctum')->id());
            if ($us->type == 1) {
                $p = Owner::where('user_id', Auth::guard('sanctum')->id())->first();
                $p->update([
                    'passport_expiry_date' => $request->passport_expiry,
                ]);
            }

            if ($us->type == 2) {
                $p = Tenant::where('user_id', Auth::guard('sanctum')->id())->first();
                $p->update([
                    'passport_expiry_date' => $request->passport_expiry,
                ]);
            }

            $docs->update([
                'passport_expiry' => $request->passport_expiry,
            ]);
        }
        $input = $request->all();
        $input['passport'] = $docs->passport;
        if ($request->hasFile('passport')) {
            $file = $request->file('passport'); // UplodedFile Object
            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);
            $request->merge([
                'passport' => $image_path,
            ]);
            $input['passport'] = $image_path;
            $docs->update([
                'passport' => $image_path,
            ]);
        }
        if ($request->hasFile('title_dead')) {
            $file = $request->file('title_dead'); // UplodedFile Object

            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);
            $request->merge([
                'title_dead' => $image_path,
            ]);
            $input['title_dead'] = $image_path;

            $docs->update([
                'title_deed' => $image_path,
            ]);
        }

        if ($request->hasFile('emirateId_image')) {
            $file = $request->file('emirateId_image'); // UplodedFile Object

            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);
            $request->merge([
                'emirateId_image' => $image_path,
            ]);
            $input['emirateId_image'] = $image_path;
            $docs->update([
                'emirates_id' => $image_path,
            ]);
        }

        if ($request->hasFile('tenancy_contract')) {
            $file = $request->file('tenancy_contract'); // UplodedFile Object

            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);
            $request->merge([
                'tenancy_contract' => $image_path,
            ]);
            $input['tenancy_contract'] = $image_path;
            $docs->update([
                'contracts' => $image_path,
            ]);
        }

        $WorkPermit = WorkPermit::create($input);
        return response()->json([
            'status' => true,
            'code' => 201,
            'message' => __('messages.Enquiry'),
            'data' => $WorkPermit,
        ]);
    }

    public function deliveryPermit(Request $request)
    {


        $validation = Validator::make($request->all(), [
            'date' => 'required',
            'delivery_company' => 'required',
            'description' => 'required',

            'resident_name' => 'required',
            'resident_country' => 'required',
            'children_number' => 'nullable',
            'aduls' => 'required',
            'resident_mobile' => 'required',


            'officer_number' => 'required',
            'emirate_id' => 'nullable',

            'contact' => 'required',
            'property_id' => 'required|exists:properties,id',

            'tenancy_contract' => 'nullable',
            'contract_expiry' => 'nullable',
            'passport' => 'nullable',
            'passport_expiry' => 'nullable',
            'title_dead' => 'nullable',
            'emirateId_image' => 'nullable',
        ]);

        if ($validation->fails()) {
            return  response()->json([
                'status' => false,
                'code' => 422,
                'message' => '',
                'data' => $validation->errors(),
            ], 422);
        }
        $passport_number = User::find(Auth::guard('sanctum')->id())->passport_number ?? null;
        $own = Owner::where('user_id', Auth::guard('sanctum')->id())->first();
        $passport_expiry_dateO = $own->passport_expiry_date ?? null;
        $passportO = $own->passport_copy ?? null;
        $ten = Tenant::where('user_id', Auth::guard('sanctum')->id())->first();
        $passport_expiry_dateT = $ten->passport_expiry_date ?? null;
        $passportT = $ten->passport_copy ?? null;
        $docs = UserProfile::where('user_id', Auth::guard('sanctum')->id())->first();

        //  return $request->all();

        if (!$docs) {
            UserProfile::create([
                'user_id' => Auth::guard('sanctum')->id(),
            ]);

            $docs = UserProfile::where('user_id', Auth::guard('sanctum')->id())->first();
        } else {
            $docs->update([
                'contract_expiry' => $request->contract_expiry,
            ]);
        }

        $request->merge([
            'user_id' => Auth::guard('sanctum')->id(),
            'passport_number' => $request->passport_number ?? $passport_number,
            'passport_expiry' => $request->passport_expiry ?? $docs->passport_expiry,
            'emirateId_image' => $docs->emirates_id ?? null,
            'passport' => $passportO ?? $passportT,
            'contract_expiry' => $request->contract_expiry ?? null,
        ]);

        if ($request->passport_number) {
            $us = User::find(Auth::guard('sanctum')->id());
            $us->update([
                'passport_number' => $request->passport_number,
            ]);
        }
        if ($request->passport) {
            $us = User::find(Auth::guard('sanctum')->id());
            if ($us->type == 1) {
                $owner = Owner::where('user_id', Auth::guard('sanctum')->id())->first();
                $owner->update([
                    'passport_copy' => $request->passport,
                ]);
                $docs->update([
                    'passport' => $request->passport,
                ]);
            }
            if ($us->type == 2) {
                $tenant = Tenant::where('user_id', Auth::guard('sanctum')->id())->first();
                $tenant->update([
                    'passport_copy' => $request->passport,
                ]);
            }
        }

        if ($request->passport_expiry) {
            $us = User::find(Auth::guard('sanctum')->id());
            if ($us->type == 1) {
                $p = Owner::where('user_id', Auth::guard('sanctum')->id())->first();
                $p->update([
                    'passport_expiry_date' => $request->passport_expiry,
                ]);
            }

            if ($us->type == 2) {
                $p = Tenant::where('user_id', Auth::guard('sanctum')->id())->first();
                $p->update([
                    'passport_expiry_date' => $request->passport_expiry,
                ]);
            }

            $docs->update([
                'passport_expiry' => $request->passport_expiry,
            ]);
        }




        $input = $request->all();
        $input['passport'] = $docs->passport;
        if ($request->hasFile('passport')) {
            $file = $request->file('passport'); // UplodedFile Object

            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);
            $request->merge([
                'passport' => $image_path,
            ]);
            $input['passport'] = $image_path;
        }
        if ($request->hasFile('title_dead')) {
            $file = $request->file('title_dead'); // UplodedFile Object

            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);
            $request->merge([
                'title_dead' => $image_path,
            ]);
            $input['title_dead'] = $image_path;
        }

        if ($request->hasFile('emirateId_image')) {
            $file = $request->file('emirateId_image'); // UplodedFile Object

            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);
            $request->merge([
                'emirateId_image' => $image_path,
            ]);
            $input['emirateId_image'] = $image_path;
        }

        if ($request->hasFile('tenancy_contract')) {
            $file = $request->file('tenancy_contract'); // UplodedFile Object

            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);
            $request->merge([
                'tenancy_contract' => $image_path,
            ]);
            $input['tenancy_contract'] = $image_path;
        }

        $DeliveryPermit = DeliveryPermit::create($input);

        return response()->json([
            'status' => true,
            'code' => 201,
            'message' => __('messages.Enquiry'),
            'data' => $DeliveryPermit,
        ]);
    }
}
