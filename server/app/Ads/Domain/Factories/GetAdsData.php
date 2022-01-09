<?php

namespace App\Ads\Domain\Factories;

use App\Ads\Domain\Contracts\IndexAdsQueriesInterface;

class GetAdsData
{
    public $ads;

    public function __construct(IndexAdsQueriesInterface $ads)
    {
        $this->ads = $ads;
    }

    public function getAll()
    {
        return $this->ads->query();
    }
}
