<?php

namespace App\Providers;

use App\Models\Collaboration;
use App\Models\User;
use App\Models\Work;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Role
        Gate::define('admin', function (User $user) : bool{
            return (bool) $user->is_admin;
        });
    }
}
