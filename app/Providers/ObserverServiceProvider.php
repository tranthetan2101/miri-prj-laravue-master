<?php

namespace App\Providers;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Observers\UserObserver;
use App\Models\Order;
use App\Observers\Order\OrderObserver;
use Illuminate\Support\ServiceProvider;

/**
 * Class ObserverServiceProvider.
 */
class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Order::observe(OrderObserver::class);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        //
    }
}
