<?php

namespace App\Campaigns\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;

class UpdateCampaignService extends Service
{
    public function handle($data = [], $campaign = null)
    {
        if (auth()->user()->id == $campaign->owner_id || 1) {
            $campaign->update($data);
            return new GenericPayload($campaign, 200);
        }
    }
}
