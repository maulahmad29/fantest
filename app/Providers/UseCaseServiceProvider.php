<?php

namespace App\Providers;

use App\Applications\Interfaces\UseCase\IApprovalEpresenceServices;
use App\Applications\Interfaces\UseCase\IEpresenceServices;
use App\Applications\Services\UseCase\ApprovalEpresenceServices;
use App\Applications\Services\UseCase\EpresenceServices;
use Illuminate\Support\ServiceProvider;

class UseCaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IEpresenceServices::class, EpresenceServices::class);
        $this->app->bind(IApprovalEpresenceServices::class, ApprovalEpresenceServices::class);
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
