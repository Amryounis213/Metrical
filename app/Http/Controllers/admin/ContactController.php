<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactWithAdmin;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $title = 'Contact Requests Table';
        $contacts = ContactWithAdmin::latest()->paginate(5);
        
        return view('admin.contact.index', [
            'contacts' => $contacts,
            'title' => $title
        ]);
    }
}
