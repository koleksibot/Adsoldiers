<?php

namespace App\Analytics\Domain\Services;

use Illuminate\Support\Facades\DB;
use App\App\Domain\Services\Service;
use App\App\Domain\Payloads\GenericPayload;
use App\Analytics\Domain\Traits\AdStatistics;

class ShowAdvertiserAnalyticService extends Service
{
    use AdStatistics;

    public function __construct()
    {
        $this->whereClause = 'advertiser_id = ' . (auth()->user() ? auth()->user()->id : '');
    }

    public function handle($data = [])
    {
        $ads = [
            'advertiser_id' => auth()->user()->id,
            'ages' => $this->indexVisitorsStats('stats_ages', 'stats_age_ad'),
            'genders' => $this->indexVisitorsStats('stats_genders', 'stats_gender_ad'),
            'audience' => $this->indexVisitorsStats('stats_audience', 'stats_audience_ad'),
            'country' => $this->indexVisitorsStats('stats_countries', 'stats_country_ad'),
            'clicks' => $this->getClicksLocally(auth()->user()->id, 'clicks'),
            'monthly_clicks' => $this->getClicksLocally(auth()->user()->id, 'monthly_clicks'),
        ];
        return new GenericPayload($ads);
    }

    /**
     * Get Advertiser's ads click form out local DB not from google analytics directly
     *
     * @param string advertiser_id
     *
     * @return integer clicks
     */
    public function getClicksLocally(string $advertiser_id = null, string $attribute)
    {
        $clicks = DB::table('ads')
            ->select(
                DB::raw('SUM(' . $attribute . ')  as ' . $attribute)
            )
            ->whereAdvertiserId($advertiser_id)
            ->first();

        return head($clicks);
    }
}
