<?php

namespace App\Campaigns\Actions;

use App\Campaigns\Domain\Services\IndexCampaignService;
use App\Campaigns\Responders\IndexCampaignResponder;

class IndexCampaignAction 
{
    public function __construct(IndexCampaignResponder $responder, IndexCampaignService $services) 
    {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke() 
    {
        return $this->responder->withResponse(
            $this->services->handle()
        )->respond();
    }
}