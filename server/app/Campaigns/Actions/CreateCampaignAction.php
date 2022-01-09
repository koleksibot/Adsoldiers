<?php

namespace App\Campaigns\Actions;

use App\Campaigns\Domain\Requests\CreateCampaignFormRequest;
use App\Campaigns\Domain\Services\CreateCampaignService;
use App\Campaigns\Responders\CreateCampaignResponder;

class CreateCampaignAction
{
    public function __construct(CreateCampaignResponder $responder, CreateCampaignService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(CreateCampaignFormRequest $request)
    {
        return $this->responder->withResponse(
            $this->services->handle($request->validated())
        )->respond();
    }
}
