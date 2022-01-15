<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ServiceMail;
use App\Models\DeliveryPermit;
use App\Models\MoveIn;
use App\Models\MoveOut;
use App\Models\User;
use App\Models\WorkPermit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class servicesController extends Controller
{

    /* MoveIns Function */
    public function deliveryResult(Request $request)
    {

        $deliveries = DeliveryPermit::where('delivery_company', 'LIKE', '%' . $request->name . '%')->paginate(10);

        return view('admin.services.delivery.index', [
            'deliveries' => $deliveries,
            'title' => 'Show All Results',

        ]);
    }
    public function deliveries()
    {

        $deliveries = DeliveryPermit::orderBy('agree', 'asc')
            ->get();


        return view('admin.services.delivery.index', [
            'deliveries' => $deliveries,
            'title' => 'Show Unaccepted Deliveries',

        ]);
    }

    public function acceptedDeliveries()
    {
        $deliveries = DeliveryPermit::with(['user'])->where('agree', '=', 1)->get();
        return view('admin.services.delivery.index', [
            'deliveries' => $deliveries,
            'title' => 'Show Accepted Deliveries'
        ]);
    }

    public function acceptDelivery($id)
    {
        $service = DeliveryPermit::findOrFail($id);
        $service->update([
            'agree' => 1
        ]);
        return redirect()->back();
    }
    public function refuseDelivery($id)
    {
        $service = DeliveryPermit::findOrFail($id);
        $service->delete();
        return redirect()->route('deliveries');
    }
    /* End Of Moveins */
    /* MoveIns Function */
    public function moveinResult(Request $request)
    {

        $moveIn = MoveIn::where('full_name', 'LIKE', '%' . $request->name . '%')->paginate(10);

        return view('admin.services.movein.index', [
            'moveIn' => $moveIn,
            'title' => 'Show All Results'
        ]);
    }
    public function moveIns()
    {
        $moveIn = MoveIn::orderBy('agree', 'asc')
            ->get();

        return view('admin.services.movein.index', [
            'moveIn' => $moveIn,
            'title' => 'Show Unaccepted Moveins'
        ]);
    }

    public function acceptedMoveIns()
    {
        $moveIn = MoveIn::with(['user'])
            ->where('agree', '=', true)->get();
        return view('admin.services.movein.index', [
            'moveIn' => $moveIn,
            'title' => 'Show Accepted Moveins'
        ]);
    }

    public function acceptMovein($id)
    {
        $service = MoveIn::findOrFail($id);
        $service->update([
            'agree' => true
        ]);
        return redirect()->back();
    }
    public function refuseMovein($id)
    {
        $service = MoveIn::findOrFail($id);
        $service->delete();
        return redirect()->route('moveins');
    }
    /* End Of Moveins */

    /* MoveOuts Function */
    public function moveoutResult(Request $request)
    {

        $moveout = MoveOut::where('full_name', 'LIKE', '%' . $request->name . '%')->paginate(10);

        return view('admin.services.moveout.index', [
            'moveout' => $moveout,
            'title' => 'Show All Results'
        ]);
    }
    public function moveouts()
    {
        $moveout = MoveOut::with('user')->orderBy('agree', 'asc')
            ->get();
        return view('admin.services.moveout.index', [
            'moveout' => $moveout,
            'title' => 'Show Unaccepted Moveouts'
        ]);
    }

    public function acceptedMoveouts()
    {
        $moveout = MoveOut::with(['user'])->where('agree', '=', true)->get();
        return view('admin.services.moveout.index', [
            'moveout' => $moveout,
            'title' => 'Show Accepted Moveouts'
        ]);
    }

    public function acceptMoveout($id)
    {
        $service = MoveOut::findOrFail($id);
        $service->update([
            'agree' => true
        ]);
        return redirect()->back();
    }
    public function refuseMoveout($id)
    {
        $service = MoveOut::findOrFail($id);
        $service->delete();
        return redirect()->back();
    }
    /* End Of Moveins */

    /**
     * 
     * Start Work Primit (Amr Yon)
     */

    public function WorkPermits()
    {


        $workpermit = WorkPermit::with('user')
            ->orderBy('agree', 'asc')
            ->get();


        return view('admin.services.work.index', [
            'workpermit' => $workpermit,
            'title' => 'Show Unaccepted Deliveries',

        ]);
    }

    public function acceptWorkPermits($id)
    {
        $service = WorkPermit::findOrFail($id);
        $service->update([
            'agree' => 1
        ]);
        Mail::to('amroka@gmail.com')->send(new ServiceMail());
        return redirect()->back();
    }

    public function refuseWorkPermits($id)
    {
        $service = WorkPermit::findOrFail($id);
        $service->delete();
        return redirect()->route('WorkPermits');
    }
    function ShowFullRequest($id, $type)
    {

        if ($type == 'movein') {
            $service = MoveIn::with('user')->where('id', $id)->first();
        } else if ($type == 'delivery-premit') {
            $service = DeliveryPermit::with('user')->where('id', $id)->first();
        } else if ($type == 'moveout') {
            $service = Moveout::with('user')->where('id', $id)->first();
        } else if ($type == 'work-premit') {
            $service = WorkPermit::with('user')->where('id', $id)->first();
        } else {
            'none';
        }

        return view('admin.services.show-details', ['service' => $service, 'type' => $type]);
    }
}
