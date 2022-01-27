<?php

namespace App\Providers;

use App\Applications\Interfaces\Identity\IAuthServices;
use App\Applications\Services\Identity\AuthServices;
use Illuminate\Support\ServiceProvider;

class IdentityServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IAuthServices::class, AuthServices::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
