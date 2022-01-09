<?php

/**
 * Apis for authenticated users
 * PHP version 7.2
 */
Route::group(
    ['prefix' => 'auth'],
    function () {
        Route::post('/change-password', \App\Users\Actions\ChangePasswordAction::class);
        Route::post('/logout', \App\Users\Actions\LogoutUserAction::class);
        Route::get('/user', \App\Users\Actions\GetAuthenticatedUserAction::class);
        Route::post('/profile/update', \App\Users\Actions\UpdateProfileAction::class);
        Route::get('/profile/{user}', \App\Users\Actions\ShowUserProfileAction::class);
    }
);
Route::group(
    ['prefix' => 'users'],
    function () {
        Route::get('', \App\Users\Actions\IndexUsersAction::class);
        Route::post('/create', \App\Users\Actions\CreateUserAction::class);
        Route::post('tutorial/{user}', \App\Users\Actions\UserTutorialAction::class);
        Route::post('/{user}/{slug}', \App\Users\Actions\ChangeUserRoleAction::class);
    }
);

Route::group(
    ['prefix' => 'campaigns'],
    function () {
        Route::get('/', \App\Campaigns\Actions\IndexCampaignAction::class);
        Route::post('/create', \App\Campaigns\Actions\CreateCampaignAction::class);
        Route::get('/{campaign}', \App\Campaigns\Actions\ShowCampaignAction::class);
        Route::post('/{campaign}', \App\Campaigns\Actions\UpdateCampaignAction::class);
        Route::delete('/{campaign}', \App\Campaigns\Actions\DeleteCampaignAction::class);
    }
);

Route::group(
    ['prefix' => 'ads'],
    function () {
        Route::post('/create', \App\Ads\Actions\CreateAdAction::class);
        Route::post('/{ad}', \App\Ads\Actions\UpdateAdAction::class);
        Route::post('/{ad}/activate', \App\Ads\Actions\ActivateAdAction::class);
        Route::post('/{ad}/subscribe', \App\Ads\Actions\SubscribeAdAction::class);
        Route::delete('/{ad}', \App\Ads\Actions\DeleteAdAction::class);
        Route::get('countries', \App\Ads\Actions\IndexCountriesAction::class);
        Route::get('cities/{country_id}', \App\Ads\Actions\IndexCitiesAction::class);
        Route::get('language', \App\Ads\Actions\IndexLanguageAction::class);
    }
);

Route::group(
    ['prefix' => 'libraries'],
    function () {
        // Route::get('/', \App\Libraries\Actions\IndexLibraryAction::class);
        Route::get('/categories', \App\Libraries\Actions\IndexCategoryAction::class);
        Route::get('/categories/{category}', \App\Libraries\Actions\ShowCategoryAction::class);
        Route::post('/create', \App\Libraries\Actions\CreateLibraryAction::class);
        Route::post('/{library}', \App\Libraries\Actions\UpdateLibraryAction::class);
        Route::get('/{library}', \App\Libraries\Actions\ShowLibraryAction::class);
        Route::delete('/{library}', \App\Libraries\Actions\DeleteLibraryAction::class);
    }
);

Route::group(
    ['prefix' => 'tasks'],
    function () {
        Route::get('/', \App\Tasks\Actions\IndexTasksAction::class);
        Route::post('/create', \App\Tasks\Actions\CreateTaskAction::class);
        Route::post('/{task}', \App\Tasks\Actions\UpdateTaskAction::class);
        Route::delete('/{task}', \App\Tasks\Actions\DeleteTaskAction::class);
    }
);

Route::group(
    ['prefix' => 'statistics'],
    function () {
        Route::get('/advertiser', \App\Analytics\Actions\ShowAdvertiserAnalyticAction::class);
        Route::get('/ads/{ad}', \App\Analytics\Actions\ShowAdAnalyticAction::class);
        Route::get('/campaigns/{campaign}', \App\Analytics\Actions\ShowCampaignAnalyticAction::class);
    }
);

Route::group(
    ['prefix' => 'notifications'],
    function () {
        Route::get('/', \App\Notifications\Actions\IndexNotificationsAction::class);
        Route::get('/{notification}', \App\Notifications\Actions\ShowNotificationAction::class);
        Route::post('/{notification}', \App\Notifications\Actions\ReadNotificationAction::class);
    }
);

Route::group(
    ['prefix' => 'me'],
    function () {
        Route::get('/statistics', \App\Analytics\Actions\ShowSoldierAnalyticAction::class);
        Route::get('/balance', \App\PaymentMethods\Actions\IndexUserBalanceAction::class);
        Route::get('/advertiser/transactions', \App\Payment\Advertiser\Actions\IndexAdvertiserOwnTransactionsAction::class);
        Route::get('/soldier/transactions', \App\Payment\Soldier\Actions\IndexSoldierOwnTransactionsAction::class);
    }
);

Route::group(
    ['prefix' => 'soldier'],
    function () {
        Route::get('/levelup', \App\Analytics\Actions\SoldierLevelUpAction::class);

        Route::group(
            ['prefix' => 'transactions'],
            function () {
                Route::get('', \App\Payment\Admin\Actions\IndexSoldiersTransactionsAction::class);
                Route::post('{transaction}/cancel', \App\Payment\Shared\Actions\CancelTransactionAction::class);
                Route::post('{transaction}/done', \App\Payment\Admin\Actions\ConvertTransactionToDoneAction::class);
            }
        );
    }
);

Route::group(
    ['prefix' => 'advertiser/transactions'],
    function () {
        Route::get('', \App\Payment\Admin\Actions\IndexAdvertisersTransactionsAction::class);
        Route::post('', \App\Payment\Advertiser\Actions\StoreTransactionAction::class);
        Route::post('/status', \App\Payment\Advertiser\Actions\ShowHyperPayTransactionStatusAction::class);
    }
);

Route::post('/settings', \App\Settings\Actions\UpdateSettingAction::class);

Route::get('/payment-methods', \App\PaymentMethods\Actions\IndexPaymentMethodsAction::class);
Route::post('payment-methods', \App\PaymentMethods\Actions\StorePaymentMethodAction::class);
