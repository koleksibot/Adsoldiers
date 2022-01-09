<?php

namespace App\Ads\Domain\Services;

use App\Ads\Domain\Models\Ad;
use App\Ads\Domain\Repositories\AdRepository;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Payloads\UnauthorizedPayload;
use App\App\Domain\Services\Service;

class DeleteAdService extends Service
{
    public function handle(Ad $ad = null)
    {
        if (auth()->user()->can('delete-ad')
            && ($ad->campaign->owner->id == auth()->user()->id)
        ) {
            try {
                $ad->delete();
                return new GenericPayload(
                    [
                    'message' => 'Ad Deleted Successfully!',
                    ]
                );
            } catch (Exception $e) {
                return new ValidationPayload($e);
            }
        }
        return new UnauthorizedPayload;
    }
}
