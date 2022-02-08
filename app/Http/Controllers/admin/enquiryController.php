<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
        Gate::authorize('enquires.view');
        $title = 'Enquires Table';
        $enquiry = Enquiry::with('property')->paginate(5);
        return view('admin.enquires.index', [
            'enquiry' => $enquiry,
            'title ' => $title,
        ]);
    }


    public function delete($id)
    {
        $enquiry = Enquiry::find($id);
        $enquiry->delete();
        return redirect()->back();
    }

    public function makeAsRead($id)
    {
        $enquiry = Enquiry::find($id);
        $enquiry->update([
            'is_read' => true,
        ]);
        return redirect()->back();
    }
}
