<?php

namespace App\Campaigns\Domain\Observers;

use App\Campaigns\Domain\Models\Campaign;

class CampaignObserver
{
    public function creating(Campaign $campaign)
    {
        $campaign->owner_id = !is_null($user = auth()->user()) ?  $user->id :  $campaign->owner_id;
    }
}
