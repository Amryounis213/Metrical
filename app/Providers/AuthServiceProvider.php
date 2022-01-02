<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        foreach (config('abilities') as $key => $value) {
            Gate::define($key, function ($user) use ($key) {
                $rules = Role::whereRaw('id IN (SELECT role_id FROM role_user WHERE user_id = ?)', [
                    $user->id,
                ])->get();
                foreach ($rules as $rule) {

                    if (in_array($key, $rule->abilities)) {
                        return true;
                    }
                }
                return false;
            });
        }
    }
}
