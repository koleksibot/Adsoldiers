<?php

namespace App\Ads\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Ads\Domain\Repositories\AdRepository;

class ActivateAdService extends Service
{
    protected $ads;

    public function __construct(AdRepository $ads)
    {
        $this->ads = $ads;
    }

    public function handle($ad = [])
    {
        $ad->update(['status' => 'active']);
        return new GenericPayload(['message' => 'Ad Activated Successfully!']);
    }
}
