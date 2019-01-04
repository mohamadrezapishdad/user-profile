<?php

namespace Larafa\UserProfile;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class ProfileServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations/2019_01_00_000000_create_profiles_table.php');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'user-profile');

        $this->publishes([
            __DIR__.'/factories/ProfileFactory.php' => database_path('factories/ProfileFactory.php')
        ], 'factories');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
