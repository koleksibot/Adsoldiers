<?php

namespace App\Ads\Domain\Services;

use App\App\Domain\Services\Service;
use App\Ads\Domain\Factories\GetAdsData;
use App\App\Domain\Payloads\GenericPayload;

class IndexAdService extends Service
{
    protected $ads;

    public function __construct(GetAdsData $ads)
    {
        $this->ads = $ads;
    }

    public function handle($data = [])
    {
        return new GenericPayload(
            $this->ads->getAll()
        );
    }
}
