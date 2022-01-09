<?php

use Spatie\Analytics\Period;
use App\Ads\Domain\Models\Ad;
use Spatie\Analytics\Analytics;
use App\Users\Domain\Models\User;
use App\Ads\Domain\Notifications\AdCreated;
use App\App\Domain\Notifications\Models\DatabaseNotification;

/**
 * Apis for Public users(visitors)
 * PHP version 7.2
 */
// campaigns
// Route::get('campaigns/{campaign}', \App\Campaigns\Actions\ShowCampaignAction::class);
// ads
Route::get('ads', \App\Ads\Actions\IndexAdAction::class);
Route::get('ads/{ad}', \App\Ads\Actions\ShowAdAction::class);
// tasks
Route::get('tasks/{task}', \App\Tasks\Actions\ShowTaskAction::class);
// Google AnalyticsZ
Route::get('analytics', \App\Analytics\Actions\IndexAnalyticsAction::class);
Route::post('payments/decrypt', \App\PaymentMethods\Actions\DecryptBayanPayAction::class);
Route::post('payments/encrypt', \App\PaymentMethods\Actions\EncryptPaymentFormAction::class);
Route::get('a', function () {
    function a()
    {
        $url = "https://test.oppwa.com/v1/checkouts";
        $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
                    "&amount=92.00" .
                    "&currency=EUR" .
                    "&paymentType=DB";
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                       'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;
    }
    return a();
  
    // $this->filter = 'ga:pagePathLevel3=@/vrKnVy8QxkcLTPGqlWIpyx8Em6TyTQ1P';
    // $this->filter = 'ga:pagePathLevel2=@/Ad Two';

    // $a = $this->getUserAdBalance();
    // dd($a);
    // dd(Period::days($today));
    // $user = User::find(3);
    // $ad = Ad::find(2);
    // $user->notify(new AdCreated($ad));

    // $notification = DatabaseNotification::find('570df782-df91-450c-bdf2-74dc421fdeab');
    // dd($notification->models);

    // $ad1 = (Ad::whereJsonContains('country', 'Egypt')->get());
    // $ad2 = (Ad::whereJsonContains('country', 'Bahrain')->get());
    // return $ad1->merge($ad2);
});
Route::post('analytics/store', \App\Analytics\Actions\StoreAnalyticAction::class);
// Route::post('analytics/ad', \App\Analytics\Actions\StoreAdAnalyticAction::class);

Route::get('/settings', \App\Settings\Actions\IndexSettingsAction::class)->name('settings');
Route::post('/contact', \App\Contact\Actions\StoreContactMessageAction::class);
