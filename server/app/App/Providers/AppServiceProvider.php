<?php

namespace App\App\Providers;

use Stripe\Stripe;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\App\Domain\Cart\Payments\Gateway;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use App\App\Domain\Cart\Payments\Gateways\StripeGateway;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Gateway::class, function () {
            return new StripeGateway();
        });

        // bind users role with the Ads Query corresponding to it
        app()->singleton('guest', \App\Ads\Domain\IndexAdsQueries\GuestIndexAdsQuery::class);
        app()->singleton('admin', \App\Ads\Domain\IndexAdsQueries\AdminIndexAdsQuery::class);
        app()->singleton('advertiser', \App\Ads\Domain\IndexAdsQueries\AdvertiserIndexAdsQuery::class);
        app()->singleton('soldier', \App\Ads\Domain\IndexAdsQueries\SoldierIndexAdsQuery::class);

        // Contextual Binding of the (Index Ads Query) Factory with Ads Query classes
        app()->when(\App\Ads\Domain\Factories\GetAdsData::class)
            ->needs(\App\Ads\Domain\Contracts\IndexAdsQueriesInterface::class)
            ->give(function () {
                if (!auth()->check()) {
                    return app('guest');
                }

                return app(auth()->user()->roles()->first()->slug);
            });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Stripe::setApiKey(config('services.stripe.secret'));
    }
}
