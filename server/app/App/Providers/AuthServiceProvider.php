<?php

namespace App\App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //creating Campaign gate
        Gate::define('create-campaign', '\App\Campaigns\Domain\Policies\CampaignPolicy@create');
        //Updating Campaign gate
        Gate::define('update-campaign', '\App\Campaigns\Domain\Policies\CampaignPolicy@update');
        // Delete Campaign gate
        Gate::define('delete-campaign', '\App\Campaigns\Domain\Policies\CampaignPolicy@delete');
        //creating ad gate
        Gate::define('create-ad', '\App\Ads\Domain\Policies\AdPolicy@create');
        //creating ad gate
        Gate::define('update-ad', '\App\Ads\Domain\Policies\AdPolicy@update');
        // Delete ad gate
        Gate::define('delete-ad', '\App\Ads\Domain\Policies\AdPolicy@delete');
        // createing user gate
        Gate::define('create-user', '\App\Users\Domain\Policies\AdminPolicy@createUser');
        // Update User Gate
        Gate::define('update-user', '\App\Users\Domain\Policies\AdminPolicy@updateUser');
        // change user role gate
        Gate::define('change-user-role', '\App\Users\Domain\Policies\AdminPolicy@changeUserRole');
        // creating Task Gate
        Gate::define('create-task', '\App\Users\Domain\Policies\AdminPolicy@createTask');
        // updating Task Gate
        Gate::define('update-task', '\App\Users\Domain\Policies\AdminPolicy@updateTask');
        // Creating Library Gate
        Gate::define('create-library', '\App\Libraries\Domain\Policies\LibraryPolicy@create');
        // Update Settings Gate
        Gate::define('update-settings', '\App\Users\Domain\Policies\AdminPolicy@updateSettings');
        // Cancel transaction Gate
        Gate::define('cancel-transaction', '\App\Payment\Shared\Domain\Policies\TransactionPolicy@cancelTransaction');
        // Done transaction Gate
        Gate::define('done-transaction', '\App\Payment\Shared\Domain\Policies\TransactionPolicy@doneTransaction');
        // Index All Transactions By Only Admins
        Gate::define('index-all-transactions', '\App\Payment\Shared\Domain\Policies\TransactionPolicy@IndexAllTransactions');
    }
}
