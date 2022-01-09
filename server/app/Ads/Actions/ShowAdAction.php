<?php

namespace App\Ads\Actions;

use App\Ads\Domain\Models\Ad;
use App\Ads\Domain\Services\ShowAdService;
use App\Ads\Responders\ShowAdResponder;

class ShowAdAction {
	public function __construct(ShowAdResponder $responder, ShowAdService $services) {
		$this->responder = $responder;
		$this->services = $services;
	}
	public function __invoke(Ad $ad) {
		return $this->responder->withResponse(
			$this->services->handle($ad)
		)->respond();
	}
}