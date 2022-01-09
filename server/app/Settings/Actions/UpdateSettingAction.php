<?php

namespace App\Settings\Actions;

use App\Settings\Domain\Requests\SettingFormRequest;
use App\Settings\Domain\Services\UpdateSettingService;
use App\Settings\Responders\UpdateSettingResponder;

class UpdateSettingAction {
	public function __construct(UpdateSettingResponder $responder, UpdateSettingService $services) {
		$this->responder = $responder;
		$this->services = $services;
	}
	public function __invoke(SettingFormRequest $request) {
		return $this->responder->withResponse(
			$this->services->handle($request->validated())
		)->respond();
	}
}