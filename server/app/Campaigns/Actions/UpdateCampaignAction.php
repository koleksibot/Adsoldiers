<?php

namespace App\Campaigns\Actions;

use App\Campaigns\Domain\Models\Campaign;
use App\Campaigns\Domain\Requests\UpdateCampaignFormRequest;
use App\Campaigns\Domain\Services\UpdateCampaignService;
use App\Campaigns\Responders\UpdateCampaignResponder;

class UpdateCampaignAction {
	public function __construct(UpdateCampaignResponder $responder, UpdateCampaignService $services) {
		$this->responder = $responder;
		$this->services = $services;
	}
	public function __invoke(Campaign $campaign, UpdateCampaignFormRequest $request) {
		return $this->responder->withResponse(
			$this->services->handle($request->validated(), $campaign)
		)->respond();
	}
}