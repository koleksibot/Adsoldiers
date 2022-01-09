<?php

namespace App\App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Users\Domain\Events\UserWasRegistered::class => [
            \App\Users\Domain\Listeners\SendActivationMail::class,
        ],
        \App\Analytics\Domain\Events\SoldierAnalyticsStored::class => [
            \App\Analytics\Domain\Listeners\StoreAdAnalytics::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
