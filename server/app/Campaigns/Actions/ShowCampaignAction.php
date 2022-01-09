<?php
namespace App\Campaigns\Actions;

use App\Campaigns\Domain\Models\Campaign;
use App\Campaigns\Domain\Services\ShowCampaignService;
use App\Campaigns\Responders\ShowCampaignResponder;

class ShowCampaignAction
{
    /**
     * [__construct to instantiate this Classs' depandancies]
     *
     * @param Object $responder [instacne of ShowCampaignResponder]
     * @param Object $services  [instacne of ShowCampaignService]
     */
    public function __construct(ShowCampaignResponder $responder, ShowCampaignService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }
    /**
     * [__invoke to instantiate Object instacne of Campaign Model(class)]
     *
     * @param Integer $campaign [Campaign ID]
     *
     * @return Object             [return single campaign instace]
     */
    public function __invoke(Campaign $campaign)
    {
        return $this->responder->withResponse(
            $this->services->handle($campaign)
        )->respond();
    }
}
