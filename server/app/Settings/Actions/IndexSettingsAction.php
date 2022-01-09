<?php

namespace App\Settings\Actions;

use App\Settings\Domain\Services\IndexSettingsService;
use App\Settings\Responders\IndexSettingsResponder;

class IndexSettingsAction {
	public function __construct(IndexSettingsResponder $responder, IndexSettingsService $services) {
		$this->responder = $responder;
		$this->services = $services;
	}
	public function __invoke() {
		return $this->responder->withResponse(
			$this->services->handle()
		)->respond();
	}
}