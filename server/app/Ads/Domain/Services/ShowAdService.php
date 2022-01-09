<?php

namespace App\Ads\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;

class ShowAdService extends Service
{
    public function handle($ad = null)
    {
        return new GenericPayload($ad);
    }
}
