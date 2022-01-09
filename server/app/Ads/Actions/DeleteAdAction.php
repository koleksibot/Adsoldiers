<?php

namespace App\Ads\Actions;

use App\Ads\Domain\Models\Ad;
use App\Ads\Domain\Services\DeleteAdService;
use App\Ads\Responders\DeleteAdResponder;

class DeleteAdAction {
	public function __construct(DeleteAdResponder $responder, DeleteAdService $services) {
		$this->responder = $responder;
		$this->services = $services;
	}
	public function __invoke(Ad $ad) {
		return $this->responder->withResponse(
			$this->services->handle($ad)
		)->respond();
	}
}