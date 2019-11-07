<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Services\Auth\AuthenticationContract;
use App\Services\Auth\DefaultLumenAuth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Since no details were provided about how to authenticate a user I choose to 
        // use the container to bind an implementation of auth - allowing us to use the
        // default Lumen auth for the time being but switch to others later.
        $this->app->bind('services.auth', AuthenticationContract::class);
        $this->app->bind(AuthenticationContract::class, DefaultLumenAuth::class);
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            return $this->app->make('services.auth')->authenticate($request);
        });
    }
}
