<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::orderBy('first_name', 'ASC')->where('type', '3')->paginate(5);
        return view('admin.admins.index', [
            'title' => 'All Admins Here',
            'users' => $users
        ]);
    }
    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'unique:users,email'],
            'mobile_number'  => ['required', 'unique:users,mobile_number'],
            'password'  => 'required',
            'image' => 'nullable'
        ]);
        $request->merge([
            'type' => '3',
            'password' => Hash::make($request->password)
        ]);
        // return $request;
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $image_url = $uploadedFile->store('/', 'upload');
            $request->merge([
                'image_url' => $image_url
            ]);
        }

        User::create($request->all());
        return redirect()->back()->with('success', 'User is Created');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.admins.edit', [
            'user' => $user,
            'id' => $id
        ]);
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'unique:users,email,' . $user->id],
            'mobile_number'  => ['required', 'unique:users,mobile_number,' . $user->id],
            'password'  => 'required',
            'image' => 'nullable',
            'current_pass' => 'required'
        ]);

        //    return $request;
        if ($request->hasFile('image')) {

            $uploadedFile = $request->file('image');
            $image_url = $uploadedFile->store('/', 'upload');
            $request->merge([
                'image_url' => $image_url
            ]);
        }

        if (Hash::check($request->current_pass, $user->password) == false) {
            return redirect()->back()->with('error', 'The password is Incorrect');
        }

        $request->merge([
            'password' => Hash::make($request->password)
        ]);

        $user->update($request->all());
        return redirect()->back()->with('success', 'User is Updated');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('success', 'Admin removed successfully');
    }
}
