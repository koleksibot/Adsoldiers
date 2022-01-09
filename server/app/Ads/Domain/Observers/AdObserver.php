<?php

namespace App\Ads\Domain\Observers;

use App\Ads\Domain\Models\Ad;

class AdObserver
{
    public function creating(Ad $ad)
    {
        // dd(!is_null($user = auth()->user()));
        if (!is_null($user = auth()->user())) {
            $ad->advertiser_id = $user->id;
        }
    }
}
