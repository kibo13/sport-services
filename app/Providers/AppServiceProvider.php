<?php

namespace App\Providers;


use App\Repositories\Client\ClientRepository;
use App\Repositories\Client\ClientRepositoryInterface;
use App\Repositories\Payment\PaymentRepository;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Trainer\TrainerRepository;
use App\Repositories\Trainer\TrainerRepositoryInterface;
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
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
        $this->app->bind(TrainerRepositoryInterface::class, TrainerRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
