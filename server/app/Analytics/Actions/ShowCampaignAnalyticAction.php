<?php

namespace App\Analytics\Actions;

use App\Analytics\Domain\Services\ShowCampaignAnalyticService;
use App\Analytics\Responders\ShowCampaignAnalyticResponder;
use App\Campaigns\Domain\Models\Campaign;

class ShowCampaignAnalyticAction
{
    public function __construct(ShowCampaignAnalyticResponder $responder, ShowCampaignAnalyticService $services)
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
