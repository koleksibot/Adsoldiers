<?php

namespace App\Libraries\Actions;

use App\Libraries\Domain\Requests\CreateLibraryFormRequest;
use App\Libraries\Domain\Services\CreateLibraryService;
use App\Libraries\Responders\CreateLibraryResponder;

class CreateLibraryAction {
	public function __construct(CreateLibraryResponder $responder, CreateLibraryService $services) {
		$this->responder = $responder;
		$this->services = $services;
	}
	public function __invoke(CreateLibraryFormRequest $request) {
		return $this->responder->withResponse(
			$this->services->handle($request->validated())
		)->respond();
	}
}