<?php

namespace App\Libraries\Actions;

use App\Libraries\Domain\Models\Library;
use App\Libraries\Domain\Requests\UpdateLibraryFormRequest;
use App\Libraries\Domain\Services\UpdateLibraryService;
use App\Libraries\Responders\UpdateLibraryResponder;

class UpdateLibraryAction {
	public function __construct(UpdateLibraryResponder $responder, UpdateLibraryService $services) {
		$this->responder = $responder;
		$this->services = $services;
	}
	public function __invoke(UpdateLibraryFormRequest $request, Library $library) {
		return $this->responder->withResponse(
			$this->services->handle($request->validated(), $library)
		)->respond();
	}
}