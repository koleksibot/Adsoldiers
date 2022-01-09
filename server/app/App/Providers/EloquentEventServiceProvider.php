<?php

namespace App\App\Providers;

use App\Campaigns\Domain\Models\Campaign;
use App\Campaigns\Domain\Observers\CampaignObserver;
use Illuminate\Support\ServiceProvider;

class EloquentEventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Campaigns\Domain\Models\Campaign::observe(\App\Campaigns\Domain\Observers\CampaignObserver::class);
        \App\Users\Domain\Models\User::observe(\App\Users\Domain\Observers\UserObserver::class);
        \App\Ads\Domain\Models\Ad::observe(\App\Ads\Domain\Observers\AdObserver::class);
    }
}
