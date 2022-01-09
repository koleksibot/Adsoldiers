<?php

namespace App\Analytics\Domain\Services;

use App\App\Domain\Services\Service;
use App\App\Domain\Payloads\GenericPayload;
use App\Analytics\Domain\Traits\AdStatistics;

class ShowCampaignAnalyticService extends Service
{
    use AdStatistics;

    protected $whereClause;
    protected $campaign;

    public function handle($campaign = null)
    {
        $this->campaign = $campaign;
        $campaignAdsIds = $campaign->ads->pluck('id')->implode(',');
        $this->setWhereClause($campaignAdsIds);

        if (empty($campaignAdsIds)) {
            return new GenericPayload(
                [
                    'message' => 'Your campaign has no ads yet!'
                ],
                244
            );
        };

        $campaignStats = [
            'advertiser_id' => auth()->id(),
            'ages' => $this->indexVisitorsStats('stats_ages', 'stats_age_ad'),
            'genders' => $this->indexVisitorsStats('stats_genders', 'stats_gender_ad'),
            'audience' => $this->indexVisitorsStats('stats_audience', 'stats_audience_ad'),
            'country' => $this->indexVisitorsStats('stats_countries', 'stats_country_ad'),
            'clicks' => $campaign->ads->sum('clicks'),
            'monthly_clicks' => $campaign->ads->sum('monthly_clicks'),
        ];

        return new GenericPayload($campaignStats);
    }

    public function setWhereClause($campaignAdsIds)
    {
        $this->whereClause = 'ad_id IN (' . $campaignAdsIds . ') AND advertiser_id = ' . auth()->id();
    }
}
