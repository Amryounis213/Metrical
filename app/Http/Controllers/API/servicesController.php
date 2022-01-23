<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DeliveryPermit;
use App\Models\MoveIn;
use App\Models\MoveOut;
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

            'tenancy_contract' => 'required',
            'contract_expiry' => 'required',
            'passport' => 'required',
            'passport_expiry' => 'required',
            'title_dead' => 'required',
            'emirateId_image' => 'required',
        ]);

        if ($validation->fails()) {
            return  response()->json([
                'status' => false,
                'code' => 401,
                'message' => '',
                'data' => $validation->errors(),
            ], 401);
        }

        $request->merge([
            'user_id' => Auth::guard('sanctum')->id(),
        ]);


        $input = $request->all();
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
                'code' => 401,
                'message' => '',
                'data' => $validation->errors(),
            ], 401);
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

            'tenancy_contract' => 'required',
            'contract_expiry' => 'required',
            'passport' => 'required',
            'passport_expiry' => 'required',
            'title_dead' => 'required',
            'emirateId_image' => 'required',
        ]);

        if ($validation->fails()) {
            return  response()->json([
                'status' => false,
                'code' => 401,
                'message' => '',
                'data' => $validation->errors(),
            ], 401);
        }
        $request->merge([
            'user_id' => Auth::guard('sanctum')->id(),
        ]);
        $input = $request->all();
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

            'tenancy_contract' => 'required',
            'contract_expiry' => 'required',
            'passport' => 'required',
            'passport_expiry' => 'required',
            'title_dead' => 'required',
            'emirateId_image' => 'required',
        ]);

        if ($validation->fails()) {
            return  response()->json([
                'status' => false,
                'code' => 401,
                'message' => '',
                'data' => $validation->errors(),
            ], 401);
        }

        $request->merge([
            'user_id' => Auth::guard('sanctum')->id(),
        ]);




        $input = $request->all();
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
