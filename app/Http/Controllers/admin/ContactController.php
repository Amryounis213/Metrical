<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactWithAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ContactController extends Controller
{
    public function index()
    {
        Gate::authorize('contact.view');
        $title = 'Contact Requests Table';
        $contacts = ContactWithAdmin::latest()->paginate(5);

        return view('admin.contact.index', [
            'contacts' => $contacts,
            'title' => $title
        ]);
    }


    public function delete($id)
    {
        Gate::authorize('contact.view');

        $contacts = ContactWithAdmin::find($id);
        $contacts->delete();
        return redirect()->back();
    }
}
