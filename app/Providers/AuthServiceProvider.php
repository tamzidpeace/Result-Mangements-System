<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        Gate::define('access-student', function ($user) {
            return $user->userable_type == 'App\Student';
        });
        Gate::define('access-teacher', function ($user) {
            return $user->userable_type == 'App\Teacher';
        });
        Gate::define('approved', function ($user) {
            return $user->userable->approved==1;
        });
    }
}
