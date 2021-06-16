<?php

namespace App\Providers;

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

        Gate::define('isAdmin', function () {
            return auth()->user()->is_admin; // means if isSupern then go ahead
        });

        Gate::define('isOfficer', function () {
            return auth()->user()->is_officer; // means if isSupern then go ahead
        });

        Gate::define('isAdminOrOfficer', function () {
            return auth()->user()->is_admin || auth()->user()->is_officer; // means if isSupern then go ahead
        });

        Gate::define('isUser', function () {
            return !auth()->user()->is_officer && !auth()->user()->is_admin; // means if isSupern then go ahead
        });

    }
}
