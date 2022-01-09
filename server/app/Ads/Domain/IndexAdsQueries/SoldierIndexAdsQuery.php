<?php

namespace App\Ads\Domain\IndexAdsQueries;

use App\Ads\Domain\Models\Ad;
use App\Users\Domain\Repositories\UserRepository;
use App\Ads\Domain\Contracts\IndexAdsQueriesInterface;

class SoldierIndexAdsQuery implements IndexAdsQueriesInterface
{
    protected $ads;
    protected $users;
    protected $soldierStatsAges;
    protected $soldierStatsGenders;
    protected $soldierStatsAudiences;
    protected $soldierStatsCountries;

    public function __construct(Ad $ads, UserRepository $users)
    {
        $this->ads = $ads;
        $this->users = $users;
        $this->soldierStatsAges = $this->users->getSoldierStatsAges();
        $this->soldierStatsGenders = $this->users->getSoldierStatsGenders();
        $this->soldierStatsAudiences = $this->users->getSoldierStatsAudiences();
        $this->soldierStatsCountries = $this->users->getSoldierStatsCountries();
    }

    public function query()
    {
        $ads = $this->ads->ages($this->soldierStatsAges)
                         ->genders($this->soldierStatsGenders)
                         ->audiences($this->soldierStatsAudiences)
                         ->countries($this->soldierStatsCountries)
                         ->paginate(10);

        return $ads;
    }
}
