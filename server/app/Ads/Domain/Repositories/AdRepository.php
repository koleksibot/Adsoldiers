<?php

namespace App\Ads\Domain\Repositories;

use App\Ads\Domain\Models\Ad;
use App\App\Domain\Repositories\Repository;

class AdRepository extends Repository
{
    protected $model;
    protected $query;

    public function __construct(Ad $ads)
    {
        $this->model = $ads;
    }

    // public function getPublicAds()
    // {
    //     dd('public');
    //     $ads = $this->model
    //         ->orderBy('created_at', 'desc')
    //         ->paginate(10);

    //     return $ads;
    // }

    // public function getAdvertiserAds()
    // {
    //     dd('advertiser');
    //     $ads = auth()->user()
    //         ->ads()
    //         ->orderBy('created_at', 'desc')
    //         ->paginate(10);

    //     return $ads;
    // }

    // public function getSoldierAds()
    // {
    //     dd('soldier');
    //     $ads = $this->ages($this->soldierStatsAges)
    //         ->genders($this->soldierStatsGenders)
    //         ->audiences($this->soldierStatsAudiences)
    //         ->countries($this->soldierStatsCountries)
    //         ->paginate(10);

    //     return $ads;
    // }
}
