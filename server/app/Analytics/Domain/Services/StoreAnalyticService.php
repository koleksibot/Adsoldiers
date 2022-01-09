<?php

namespace App\Analytics\Domain\Services;

use App\App\Domain\Services\Service;
use App\App\Domain\Payloads\GenericPayload;
use App\Analytics\Domain\Jobs\StoreSoldierAnalytics;
use App\Analytics\Domain\Jobs\StoreAdAnalytics;

class StoreAnalyticService extends Service
{
    public function handle($data = [])
    {
        dispatch(
            new StoreSoldierAnalytics($data)
        );

        dispatch(
            new StoreAdAnalytics($data)
        );

        return new GenericPayload(['message' => 'Analytics stored successfully']);
    }
}
