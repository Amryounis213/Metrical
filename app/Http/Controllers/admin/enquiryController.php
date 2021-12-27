<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class enquiryController extends Controller
{
    public function result(Request $request)
    {

        $enquiries = Enquiry::where('full_name', 'LIKE', '%' . $request->name . '%')->paginate(10);

        return view('admin.enquires.result', [
            'enquiries' => $enquiries,
            'title' => 'Show All Enquiries'
        ]);
    }

    public function index()
    {
        $title = 'Enquires Table';
        $enquiry = Enquiry::with('property')->paginate(5);
        return view('admin.enquires.index', [
            'enquiry' => $enquiry,
            'title ' => $title,
        ]);
    }
}