<?php

namespace App\Ads\Domain\Models;

use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Analytics\Domain\Models\StatsAge;
use App\Campaigns\Domain\Models\Campaign;
use App\Analytics\Domain\Models\StatsGender;
use App\Analytics\Domain\Models\StatsAudience;

class Ad extends Model
{
    protected $guarded = [
        'id',
    ];
    protected $casts = [
        'media' => 'array',
        'age' => 'array',
        'country' => 'array',
        'city' => 'array',
        'language' => 'array',
        'targeted_audience' => 'array',
    ];

    protected $with = ['campaign'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id', 'id');
    }

    public function advertiser()
    {
        return $this->belongsTo(User::class, 'advertiser_id', 'id');
    }

    public function soldier()
    {
        return $this->belongsToMany(User::class, 'ad_user', 'ad_id', 'soldier_id')->withTimestamps();
    }

    public function statsAges()
    {
        return $this->belongsToMany(StatsAge::class, 'stats_age_ad', 'ad_id')->withPivot('visitors_number');
    }

    public function statsAudience()
    {
        return $this->belongsToMany(StatsAudience::class, 'stats_audience_ad', 'ad_id')->withPivot('visitors_number');
    }

    public function statsGenders()
    {
        return $this->belongsToMany(StatsGender::class, 'stats_gender_ad', 'ad_id')->withPivot('visitors_number');
    }

    public function statsCountries()
    {
        return $this->belongsToMany(StatsGender::class, 'stats_country_ad', 'ad_id')->withPivot('visitors_number');
    }

    /* Local Scoops */

    /**
     * Scope a query to only include ads.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param String                                $soldierStatsAges
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAges($query, $soldierStatsAges)
    {
        $soldierStatsAges ? $query->orWhere('age', 'REGEXP', $soldierStatsAges) : $query;
    }

    /**
     * Scope a query to only include ads.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param String                                $soldierStatsGenders
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGenders($query, $soldierStatsGenders)
    {
        $soldierStatsGenders ? $query->orWhere('gender', 'REGEXP', $soldierStatsGenders) : $query;
    }

    /**
     * Scope a query to only include ads.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param String                                $soldierStatsAudiences
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAudiences($query, $soldierStatsAudiences)
    {
        $soldierStatsAudiences ? $query->orWhere('targeted_audience', 'REGEXP', $soldierStatsAudiences) : $query;
    }

    /**
     * Scope a query to only include ads.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param String                                $soldierStatsCountries
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCountries($query, $soldierStatsCountries)
    {
        $soldierStatsCountries ? $query->orWhere('country', 'REGEXP', $soldierStatsCountries) : $query;
    }
}
