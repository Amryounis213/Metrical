<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class OtherServicesController extends Controller
{
    public function getServices()
    {
        $services = Service::get();
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Other Services',
            'services' => $services,
        ]);
    }
}
