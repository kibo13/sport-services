<?php

namespace App\Providers;


use App\Repositories\Activity\ActivityRepository;
use App\Repositories\Activity\ActivityRepositoryInterface;
use App\Repositories\Card\CardRepository;
use App\Repositories\Card\CardRepositoryInterface;
use App\Repositories\Client\ClientRepository;
use App\Repositories\Client\ClientRepositoryInterface;
use App\Repositories\Event\EventRepository;
use App\Repositories\Event\EventRepositoryInterface;
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
        $this->app->bind(ActivityRepositoryInterface::class, ActivityRepository::class);
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
        $this->app->bind(TrainerRepositoryInterface::class, TrainerRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(CardRepositoryInterface::class, CardRepository::class);
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
