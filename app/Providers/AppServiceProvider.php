<?php

namespace App\Providers;

use app\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('admin', function(User $user) {
            // return (in_array($user->level_user->nama_level,['admin','manajemen']));
            return ($user->level_user->nama_level === 'admin');
        });

        Gate::define('manajemen', function(User $user) {
            return ($user->level_user->nama_level === 'manajemen');
        });

        Gate::define('kaprog', function(User $user) {
            return ($user->level_user->nama_level === 'kaprog');
        });
    }

}
