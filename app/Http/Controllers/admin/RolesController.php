<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class RolesController extends Controller
{

    public function result(Request $request)
    {

        $roles = Role::where('name', 'LIKE', '%' . $request->name . '%')->paginate(10);

        return view('admin.roles.result', [
            'roles' => $roles,
            'title' => 'Show All Results'
        ]);
    }
    public function index()
    {
        // Gate::authorize('roles.view-any');

        $roles = Role::paginate(10);

        return view('admin.roles.index', [
            'roles' => $roles,
            'title' => 'Show All Roles'

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Gate::authorize('roles.create');
        return view('admin.roles.create', [
            'role' => new Role(),
            'title' => 'Create New Role'

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Gate::authorize('roles.create');
        $request->validate([
            'name' => 'required',
            'abilities' => 'required|array',
        ]);

        //dd($request->all());

        $role = Role::create($request->all());

        return redirect()->route('roles.index')->with('success', 'Role added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        return $role->users;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Gate::authorize('roles.update');
        $role = Role::findOrFail($id);

        return view('admin.roles.edit', compact('role'));
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
        // Gate::authorize('roles.update');
        $request->validate([
            'name' => 'required',
            'abilities' => 'required|array',
        ]);

        $role = Role::findOrFail($id);
        $role->update($request->all());

        return redirect()->route('roles.index')->with('success', 'Role updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('roles.delete');

        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted');
    }

    public function linkUserRole(Request $request)
    {
        $roles = Role::where('name', '!=', 'super_admin')->get();
        $users = User::where('type', '3')->get();
        return view('admin.roles.link-user-role', [
            'roles' => $roles,
            'users' => $users,
            'title' => 'Add Roles To The User'
        ]);
    }

    public function storeUserRole(Request $request)
    {
        foreach ($request->roles as $role) {
            DB::table('role_user')->insert(['user_id' => $request->user_id, 'role_id' => $role]);
        }
        return redirect()->back();
    }
}
