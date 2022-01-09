<?php

namespace App\Contact\Actions;

use App\Contact\Domain\Requests\StoreContactMessageFormRequest;
use App\Contact\Domain\Services\StoreContactMessageService;
use App\Contact\Responders\StoreContactMessageResponder;

class StoreContactMessageAction {
	public function __construct(StoreContactMessageResponder $responder, StoreContactMessageService $services) {
		$this->responder = $responder;
		$this->services = $services;
	}
	public function __invoke(StoreContactMessageFormRequest $request) {
		return $this->responder->withResponse(
			$this->services->handle($request->validated())
		)->respond();
	}
}