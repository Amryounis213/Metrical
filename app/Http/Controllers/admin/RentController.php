<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Property;
use App\Models\Rent;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RentController extends Controller
{
    //

    public function store(Request $request)
    {

        $request->validate([
            'from' => 'required',
            'to' => 'required',
            'price' => 'required',
            'property_id' => 'required',
            'tenant_id' => 'required',

        ]);


        if (!Rent::where('property_id', $request->property_id)->where('status', 'active')->exists()) {
            $request->merge([
                'from' => Carbon::parse($request->from)->format('Y-m-d H:i:s'),
                'to' => Carbon::parse($request->to)->format('Y-m-d H:i:s'),
            ]);

            $property = Property::find($request->property_id);
            $property->update([
                'tenant_id' => $request->tenant_id,
            ]);
        } else {
            return redirect()->back()->with('rent', 'The Proprty has rent now');
        }


        $isRented = Rent::create($request->all());
        if ($isRented) {
            $offer = Offer::where('property_id', $request->property_id)->delete();
        }

        if ($request->redirect) {
            return redirect()->route('binding.show', Tenant::find($request->tenant_id)->user_id)->with('success', 'The Proccess Done Successfully');
        } else {
            return redirect()->back();
        }
    }


    public function StopRent($id)
    {

        $rent = Rent::where('property_id', $id)->where('status', 'active')->first();
        $property = Property::where('id', $id)->first();
        $rent->update([
            'status' => 'finished'
        ]);
        $property->update([
            'tenant_id' => null,
        ]);

        return redirect()->back();
    }


    public function showlinkform($id, $unit_number)
    {

        $tenant = Tenant::find($id);
        $property = Property::find($unit_number);
        return view('admin.users.tenantlink', [
            'tenant' => $tenant,
            'property' => $property
        ]);
    }
}
