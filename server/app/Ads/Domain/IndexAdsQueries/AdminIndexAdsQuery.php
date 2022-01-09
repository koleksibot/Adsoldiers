<?php

namespace App\Ads\Domain\IndexAdsQueries;

use App\Ads\Domain\Models\Ad;
use App\Ads\Domain\Contracts\IndexAdsQueriesInterface;

class AdminIndexAdsQuery implements IndexAdsQueriesInterface
{
    public function query()
    {
        return Ad::orderBy('created_at', 'desc')
                  ->paginate(10);
    }
}
