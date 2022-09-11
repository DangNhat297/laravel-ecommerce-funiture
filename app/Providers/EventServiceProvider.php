<?php

namespace App\Providers;

use App\Events\OrderConfirmEvent;
use App\Events\PostViewedEvent;
use App\Events\ProductViewedEvent;
use App\Listeners\PostViewedListener;
use App\Listeners\ProductViewedListener;
use App\Listeners\SendMailOrderListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ProductViewedEvent::class => [
            ProductViewedListener::class
        ],
        PostViewedEvent::class => [
            PostViewedListener::class
        ],
        OrderConfirmEvent::class => [
            SendMailOrderListener::class
        ]


    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
