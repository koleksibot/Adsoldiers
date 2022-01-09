<?php

namespace App\Analytics\Domain\Services;

use App\App\Domain\Services\Service;
use App\App\Domain\Payloads\GenericPayload;
use App\Analytics\Domain\Traits\AdStatistics;

class ShowAdAnalyticService extends Service
{
    use AdStatistics;

    protected $whereClause;

    public function handle($ad = null)
    {
        $this->setWhereClause($ad->id);

        $ad = [
            'advertiser_id' => auth()->user()->id,
            'ages' => $this->indexVisitorsStats('stats_ages', 'stats_age_ad'),
            'genders' => $this->indexVisitorsStats('stats_genders', 'stats_gender_ad'),
            'audience' => $this->indexVisitorsStats('stats_audience', 'stats_audience_ad'),
            'country' => $this->indexVisitorsStats('stats_countries', 'stats_country_ad'),
            'clicks' => $ad->clicks,
            'monthly_clicks' => $ad->monthly_clicks,
        ];
        return new GenericPayload($ad);
    }

    public function setWhereClause($adId)
    {
        $this->whereClause = 'ad_id = ' . $adId . '
                              AND
                              advertiser_id = ' . auth()->id();
    }
}
