<?php

namespace App\Ads\Domain\IndexAdsQueries;

use App\Ads\Domain\Contracts\IndexAdsQueriesInterface;

class AdvertiserIndexAdsQuery implements IndexAdsQueriesInterface
{
    public function query()
    {
        return auth()->user()
                    ->ads()
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
    }
}
