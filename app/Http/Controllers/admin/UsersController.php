<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    /* binging users */
    public function index()
    {
        $users = User::where('request_sent', '1')->where('type', '0')->get();

        return view('admin.users.index', [
            'users' => $users,
            'title' => 'Pending Users'
        ]);
    }

    public function showBindingUser($id)
    {

        $user = User::with('tenant', 'owner')->where('id', $id)->first();

        return view('admin.users.show', [
            'user' => $user
        ]);
    }

    public function acceptBinding($id)
    {

        $user = User::findOrFail($id);
        if ($user->need == 'owner') {
            $owner = Owner::where('user_id', $user->id)->first() ?? null;
            if ($owner != null) {
                $user->update([
                    'request_sent' => '0',
                    'type' => '1',
                ]);

                $owner->update(['status' => '1']);
            }
        } else {

            $tenant = Tenant::where('user_id', $user->id)->first() ?? null;
            if ($tenant != null) {
                $user->update([
                    'request_sent' => '0',
                    'type' => '2',
                ]);
                $tenant->update(['status' => '1']);
            }
        }




        $success = session()->flash('success', 'The user was Accepted');
        return redirect()->route('binding.users');
    }

    public function refuseBinding(Request $request, $id)
    {
        Gate::authorize('pending.accept');

        $user = User::findOrFail($id);

        if ($user->need == 'owner') {

            $owner = Owner::where('user_id', $user->id)->first() ?? null;
            $owner->delete();
        } else {
            $owner = Tenant::where('user_id', $user->id)->first() ?? null;
            $owner->delete();
        }



        return redirect()->route('binding.users');
    }

    public function tenants()
    {
        $users = User::with('tenant')->where('type', '2')->get();
        return view('admin.users.index', [
            'title' => 'All Tenants Here',
            'users' => $users
        ]);
    }
    public function owners()
    {
        $users = User::with('owner')->where('type', '1')->get();
        return view('admin.users.index', [
            'title' => 'All Owners Here',
            'users' => $users
        ]);
    }


    public function AllUser()
    {
        $users = User::orderBy('first_name', 'ASC')->paginate(10);
        return view('admin.users.index', [
            'title' => 'All Users Here',
            'users' => $users
        ]);
    }
}
