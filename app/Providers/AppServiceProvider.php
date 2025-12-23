<?php

namespace App\Providers;

use App\Models\Repair;
use App\Policies\RepairPolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Vite;
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
        $this->app['router']->pattern('id', '[0-9]+');
        Paginator::useBootstrapFive();
        Vite::prefetch(3);

        // Gate::define('edit', function ($user) {
        //     return $user->role === 'USER' ? false : true;
        // });

        // Gate::define('show', function ($user) {
        //     return $user->role === 'USER' ? false : true;
        // });

        // Gate::define('delete', function ($user) {
        //     return $user->role === 'USER' ? false : true;
        // });

        Gate::define('setting',function($user){
            return $user->role === "USER" ? false : true;
        });

    }
}
