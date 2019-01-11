<?php

namespace Larafa\UserProfile;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Larafa\UserProfile\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;

class ProfileServiceProvider extends AuthServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        App\User::class=>UserPolicy::class,
    ];
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations/2019_01_00_000000_create_profiles_table.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations/2019_01_01_000000_add-collumns-to-users-table.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations/2019_01_02_000000_create_followings_table.php');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'user-profile');


        $this->publishes([
            __DIR__.'/factories/ProfileFactory.php' => database_path('factories/ProfileFactory.php')
        ], 'factories');

        $this->registerPolicies();
        Gate::resource('users',UserPolicy::class);
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
