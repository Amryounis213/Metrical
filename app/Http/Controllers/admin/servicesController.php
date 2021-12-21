<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MoveIn;
use Illuminate\Http\Request;

class servicesController extends Controller
{
    public function index()
    {
        $moveIn = MoveIn::get(['id', 'full_name', 'email']);
        return view('admin.services.movein.index' , ['moveIn' =>$moveIn]);
    }
}
