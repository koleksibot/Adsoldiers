<?php

namespace App\Analytics\Domain\Jobs;

use App\Ads\Domain\Models\Ad;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Analytics\Domain\Models\StatsAge;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Analytics\Domain\Models\StatsGender;
use App\Analytics\Domain\Models\StatsCountry;
use App\Analytics\Domain\Traits\AdStatistics;
use App\Analytics\Domain\Models\StatsAudience;
use App\Analytics\Domain\Traits\GoogleAnalytics;

class StoreAdAnalytics implements ShouldQueue
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
    protected $ad;
    protected $advertiser_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->filter = 'ga:pagePathLevel2=@/' . $data['ad_id'];
        $this->data = $data;
        $this->mainModel = 'ad';
        $this->ad = Ad::whereTitle($this->data['ad_id'])->first();
        $this->advertiser_id = $this->ad->advertiser->id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->storeStatistics(
            $this->getAges(),
            app(StatsAge::class),
            [
                'advertiser_id' => $this->advertiser_id,
            ]
        );

        $this->storeStatistics(
            $this->getGenders(),
            app(StatsGender::class),
            [
                'advertiser_id' => $this->advertiser_id,
            ]
        );

        $this->storeStatistics(
            $this->getTargetedAudience(),
            app(StatsAudience::class),
            [
                'advertiser_id' => $this->advertiser_id,
            ]
        );

        $this->storeStatistics(
            $this->getCountries(),
            app(StatsCountry::class),
            [
                'advertiser_id' => $this->advertiser_id,
            ]
        );
        // update ad clicks
        $this->ad->update(
            [
                'clicks' => $this->getTotalClicks(),
                'monthly_clicks' => $this->getCurrentMonthClicks(),
            ]
        );
    }
}
