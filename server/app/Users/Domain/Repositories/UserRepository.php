<?php

namespace App\Users\Domain\Repositories;

use App\Users\Domain\Models\User;
use App\Analytics\Domain\Models\StatsAge;
use App\App\Domain\Repositories\Repository;
use App\Analytics\Domain\Models\StatsGender;
use Illuminate\Database\Eloquent\Collection;
use App\Analytics\Domain\Models\StatsCountry;
use App\Analytics\Domain\Traits\AdStatistics;
use App\Analytics\Domain\Models\StatsAudience;

class UserRepository extends Repository
{
    use AdStatistics;
    protected $model;
    protected $whereClause;

    public function __construct(User $user)
    {
        $this->model = $user;
        $this->whereClause = 'soldier_id = ' . (auth()->user() ? auth()->user()->id : '');
    }

    public function getByEmail($email)
    {
        return $this->model->where('email', $email)->firstOrFail();
    }

    public function getByCompanyId($company_id)
    {
        return $this->model->where(compact('company_id'))->firstOrFail();
    }

    public function findById($id)
    {
        return $this->model::find($id);
    }

    public function getSoldierStatsAges()
    {
        $result = $this->indexVisitorsStats('stats_ages', 'stats_age_soldier')
            ->pluck('value')
            ->toArray();

        return implode('|', $result);
    }

    public function getSoldierStatsAudiences()
    {
        $result = $this->indexVisitorsStats('stats_audience', 'stats_audience_soldier')
        ->pluck('value')
        ->toArray();

        return implode('|', $result);
    }

    public function getSoldierStatsGenders()
    {
        $result = $this->indexVisitorsStats('stats_genders', 'stats_gender_soldier')
        ->pluck('value')
        ->toArray();

        return implode('|', $result);
    }

    public function getSoldierStatsCountries()
    {
        $result = $this->indexVisitorsStats('stats_countries', 'stats_country_soldier')
        ->pluck('value')
        ->toArray();

        return implode('|', $result);
    }

    public function getMatchedSoldiers($createdAd)
    {
        $soldiers = new Collection();
        $criteriaCollection = new Collection();

        $criteriaCollection = $criteriaCollection->concat($this->getMatchedCriteria(
            app(StatsAudience::class),
            $createdAd->targeted_audience
        ));

        $criteriaCollection = $criteriaCollection->concat($this->getMatchedCriteria(
            app(StatsAge::class),
            $createdAd->age
        ));

        $criteriaCollection = $criteriaCollection->concat($this->getMatchedCriteria(
            app(StatsGender::class),
            [$createdAd->gender]
        ));

        $criteriaCollection = $criteriaCollection->concat($this->getMatchedCriteria(
            app(StatsCountry::class),
            $createdAd->country
        ));

        foreach ($criteriaCollection as $criteria) {
            $soldiers = $soldiers->merge($criteria->soldiers);
        };

        return $soldiers;
    }

    public function getMatchedCriteria($criteria, $adProperty)
    {
        return $criteriaCollection = $criteria->whereIn('value', $adProperty)->with('soldiers')->get();
    }
}
