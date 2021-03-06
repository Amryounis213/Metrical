<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Property;
use App\Models\User;
use App\Notifications\AcceptOfferNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('offers.view');
        $title = 'All Offers';
        $offers = Offer::with('property')->get();
        return view('admin.offers.index', [
            'offers' => $offers,
            'title' => $title,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $d = Property::where('id', $request->property_id)->whereDoesntHave('rent')->exists();
        if ($d) {
            Offer::create($request->all());
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offers = Offer::find($id);
        $offers->delete();
        return redirect()->back();
    }

    public function acceptOffers($id)
    {
        Gate::authorize('offers.accept');

        $offers = Offer::find($id);
        $offers->update([
            'status' => "1",
        ]);
        $user = User::find($offers->user_id);
        $user->notify(new AcceptOfferNotification($user));


        $property = Property::where('id', $offers->property_id)->first();
        $property->update(
            [
                'offer_type' => $offers->type,
            ]
        );
        return redirect()->back();
    }

    public function type($type)
    {
        $title = 'Offers';
        if ($type != 'stop') {
            $offers = Offer::where('type', $type)->get();
        } else {
            $offers = Offer::where('status', '!=', '1')->get();
        }

        return view('admin.offers.index', [
            'offers' => $offers,
            'title' => $title,
        ]);
    }

    /**
     * 
     * Action Filter
     */

    public function filter(Request $request)
    {

        if ($request->type != '') {
            $offers = Offer::with('property')
                ->where('type', $request->type)
                ->get();

            if ($request->name != '') {
                $offers = Offer::where('full_name', 'LIKE', '%' . $request->name . '%')
                    ->orwhere('email', 'LIKE', '%' . $request->name . '%')
                    ->get();
            }
        } else {
            $offers = Offer::with('property')->get();
            if ($request->name != '') {
                $offers = Offer::where('full_name', 'LIKE', '%' . $request->name . '%')
                    ->orwhere('email', 'LIKE', '%' . $request->name . '%')
                    ->get();
            }
        }
        return view('admin.offers.index', ['offers' => $offers]);
    }

    /**
     * Edit Price
     */

    public function OfferUpdate(Request $request)
    {
        $offers = Offer::find($request->offer_id);
        $offers->update($request->all());
        return redirect()->back()->with('success', 'Offer Updated Succesfully');
    }
}
