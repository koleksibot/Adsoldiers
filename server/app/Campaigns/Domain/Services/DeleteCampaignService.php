<?php
namespace App\Campaigns\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Payloads\UnauthorizedPayload;
use App\App\Domain\Payloads\ValidationPayload;
use App\App\Domain\Services\Service;
use App\Campaigns\Domain\Models\Campaign;

class DeleteCampaignService extends Service
{
    public function handle(Campaign $campaign = null)
    {
        if (auth()->user()->can('delete-campaign')
            && ($campaign->owner->id == auth()->user()->id)
        ) {
            try {
                $campaign->delete();
                return new GenericPayload(
                    [
                        'message' => 'Campagin Deleted Successfully!',
                    ]
                );
            } catch (Exception $e) {
                return new ValidationPayload($e);
            }
        }
        return new UnauthorizedPayload;
    }
}
