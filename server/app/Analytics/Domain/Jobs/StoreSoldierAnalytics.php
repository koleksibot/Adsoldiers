<?php

namespace App\Analytics\Domain\Jobs;

use Carbon\Carbon;
use App\Ads\Domain\Models\Ad;
use Illuminate\Bus\Queueable;
use App\Users\Domain\Models\User;
use Illuminate\Queue\SerializesModels;
use App\Settings\Domain\Models\Setting;
use Illuminate\Queue\InteractsWithQueue;
use App\Analytics\Domain\Models\StatsAge;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Analytics\Domain\Models\StatsGender;
use App\Analytics\Domain\Models\StatsCountry;
use App\Analytics\Domain\Traits\AdStatistics;
use App\Analytics\Domain\Models\StatsAudience;
use App\Analytics\Domain\Traits\GoogleAnalytics;

class StoreSoldierAnalytics implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use GoogleAnalytics;
    use AdStatistics;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;
    protected $filter;
    protected $data;
    protected $mainModel;
    protected $soldier;
    protected $soldier_id;
    protected $adFilter;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->filter = 'ga:pagePathLevel3=@/' . $data['user_utm'];
        $this->adFilter = 'ga:pagePathLevel2=@/' . $data['ad_id'];
        $this->data = $data;
        $this->mainModel = 'soldier';
        $this->soldier = User::whereUtm($this->data['user_utm'])->whereHas('roles', function (Builder $query) {
            $query->where('slug', 'soldier');
        })->first();
        $this->soldier_id = $this->soldier->id ?? '';
        $this->soldier_id = $this->soldier->id ?? '';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (is_null($this->soldier)) {
            return;
        }

        $this->getAdUserBalance();

        $this->storeStatistics(
            $this->getAges(),
            app(StatsAge::class)
        );

        $this->storeStatistics(
            $this->getGenders(),
            app(StatsGender::class)
        );

        $this->storeStatistics(
            $this->getTargetedAudience(),
            app(StatsAudience::class)
        );

        $this->storeStatistics(
            $this->getCountries(),
            app(StatsCountry::class)
        );

        // update ad clicks
        $this->soldier->update(
            [
                'limit' => $this->getTotalClicks(),
                'monthly_visits' => $this->getCurrentMonthClicks(),
                // 'monthly_balance' => $this->getCurrentMonthClicks() * Setting::first()->ad_click_price,
            ]
        );
    }

    public function getSoldierAdProfit($soldierAd)
    {
        $soldierAdVisitsStatistics = $this->getUserAdBalance([$this->filter, $this->adFilter]);
        // dd($soldierAdVisitsStatistics);
        // $soldierAdVisitsStatistics = 5;
        $soldierAdProfit = $soldierAdVisitsStatistics * Setting::first()->ad_click_price;

        if ($soldierAd->pivot->profit + $soldierAdProfit >= $this->soldier->limit) {
            $this->soldier->soldierAds()
                ->updateExistingPivot($soldierAd->id, ['reached_limit_at' => Carbon::now()]);

            return $this->soldier->limit;
        }

        return  $soldierAdProfit;
    }

    public function getAdUserBalance()
    {
        // get this specific ad form the current url
        $soldierAd = $this->soldier->soldierAds()->whereTitle($this->data['ad_id'])->first();
        if ($soldierAd->pivot->reached_limit_at != null) {
            return;
        }

        $soldierAdProfit = $this->getSoldierAdProfit($soldierAd);

        // add profit to user balance and substract it from ad budget
        $soldierAd->update([
            'remaining_budget' => $soldierAd->remaining_budget - $soldierAdProfit
        ]);
        $this->soldier->update([
            'balance' => $this->soldier->balance + $soldierAdProfit
        ]);

        // update pivot profit
        $this->soldier->soldierAds()->updateExistingPivot($soldierAd->id, ['profit' => $soldierAdProfit]);
    }
}
