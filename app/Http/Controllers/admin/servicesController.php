<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MoveIn;
use Illuminate\Http\Request;

class servicesController extends Controller
{
    public function moveIns()
    {
        $moveIn = MoveIn::get();

        return view('admin.services.movein.index', ['moveIn' => $moveIn]);
    }
    public function acceptMovein($id)
    {
        $service = MoveIn::findOrFail($id);
        $service->update([
            'agree' => true
        ]);
        return redirect()->route('moveins');
    }
    public function refuseMovein($id)
    {
        $service = MoveIn::findOrFail($id);
        $service->update([
            'agree' => false
        ]);
        return redirect()->route('moveins');
    }
}