<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Here we define gates
        //laravel set $user automatically :)
        Gate::define('edit-user',function($user){
            return $user->fun_has_role('admin');
        });
        Gate::define('delete-user',function($user){
            return $user->fun_has_role(['admin']);
        });
        /*Gate::define('manage-users',function($user){
            return $user->fun_has_any_roles(['admin','author']);
        });*/

        Gate::define('do-every-thing',function($user){
            return $user->fun_has_role('admin');
        });
        Gate::define('do-some-things',function($user){
            return $user->fun_has_role('user');
        });

    }
}
