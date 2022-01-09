<?php

namespace App\Campaigns\Actions;

use App\Campaigns\Domain\Models\Campaign;
use App\Campaigns\Domain\Services\DeleteCampaignService;
use App\Campaigns\Responders\DeleteCampaignResponder;

class DeleteCampaignAction
{
    public function __construct(DeleteCampaignResponder $responder, DeleteCampaignService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }

    public function __invoke(Campaign $campaign)
    {
        return $this->responder->withResponse(
            $this->services->handle($campaign)
        )->respond();
    }
}
