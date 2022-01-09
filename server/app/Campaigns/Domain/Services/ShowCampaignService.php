<?php

namespace App\Campaigns\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Campaigns\Domain\Models\Campaign;

class ShowCampaignService extends Service
{
    public function handle($campaign = null)
    {
        return new GenericPayload($campaign);
    }
}
