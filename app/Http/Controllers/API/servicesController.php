<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DeliveryPermit;
use App\Models\MoveIn;
use App\Models\MoveOut;
use App\Models\WorkPermit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class servicesController extends Controller
{

    public function moveIn(Request $request)
    {
        $user_id = Auth::guard('sanctum')->id();
        $request->validate([
            'property_id' => 'required|exists:properties,id'
        ]);
        $request->merge([
            'user_id' => $user_id
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
        if ($moveIn) {
            return response()->json([
                'status' => true,
                'code' => 201,
                'message' => __('messages.Enquiry'),
                'data' => $moveIn,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => __('messages.Enquiry'),
                'data' => $moveIn,
            ]);
        }
    }


    public function moveOut(Request $request)
    {
        $user_id = Auth::guard('sanctum')->id();
        $request->merge([
            'user_id' => $user_id
        ]);

        $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id'
        ]);
        $moveOut = MoveOut::create($request->all());
        if ($moveOut) {
            return response()->json([
                'status' => true,
                'code' => 201,
                'message' => __('messages.Enquiry'),
                'data' => $moveOut,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => __('messages.Enquiry'),
                'data' => $moveOut,
            ]);
        }
    }


    public function workPermit(Request $request)
    {
        $user_id = Auth::guard('sanctum')->id();

        $request->validate([
            'property_id' => 'required|exists:properties,id'
        ]);
        $request->merge([
            'user_id' => $user_id
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
        if ($WorkPermit) {
            return response()->json([
                'status' => true,
                'code' => 201,
                'message' => __('messages.Enquiry'),
                'data' => $WorkPermit,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => __('messages.Enquiry'),
                'data' => $WorkPermit,
            ]);
        }
    }

    public function deliveryPermit(Request $request)
    {
        $user_id = Auth::guard('sanctum')->id();
        $request->merge([
            'user_id' => $user_id
        ]);

        $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id'
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
        if ($DeliveryPermit) {
            return response()->json([
                'status' => true,
                'code' => 201,
                'message' => __('messages.Enquiry'),
                'data' => $DeliveryPermit,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => __('messages.Enquiry'),
                'data' => $DeliveryPermit,
            ]);
        }
    }
}
