<?php

namespace App\Analytics\Domain\Services;

use App\App\Domain\Services\Service;
use App\App\Domain\Payloads\GenericPayload;
use App\Analytics\Domain\Traits\AdStatistics;
use App\Analytics\Domain\Traits\GoogleAnalytics;

class ShowSoldierAnalyticService extends Service
{
    use AdStatistics, GoogleAnalytics;

    protected $whereClause;
    protected $userUtm;

    public function __construct()
    {
        $this->userUtm = (auth()->user() ? auth()->user()->utm : '');
        $this->whereClause = 'soldier_id = ' . (auth()->user() ? auth()->user()->id : '');
    }

    public function handle($data = [])
    {
        // set google analytics filter
        $this->filter = isset($this->userUtm) ? 'ga:pagePathLevel3=@/' . $this->userUtm : '';
        $stats = [
            'soldier_id' => auth()->user()->id,
            'ages' => $this->indexVisitorsStats('stats_ages', 'stats_age_soldier'),
            'genders' => $this->indexVisitorsStats('stats_genders', 'stats_gender_soldier'),
            'audience' => $this->indexVisitorsStats('stats_audience', 'stats_audience_soldier'),
            'country' => $this->indexVisitorsStats('stats_countries', 'stats_country_soldier'),
            'clicks' => $this->filter ? $this->getTotalClicks() : '',
            'monthly_clicks' => $this->filter ? $this->getCurrentMonthClicks() : '',
        ];

        return new GenericPayload($stats);
    }
}
