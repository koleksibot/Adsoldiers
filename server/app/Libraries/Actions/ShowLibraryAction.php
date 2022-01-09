<?php

namespace App\Libraries\Actions;

use App\Libraries\Domain\Models\Library;
use App\Libraries\Domain\Services\ShowLibraryService;
use App\Libraries\Responders\ShowLibraryResponder;

class ShowLibraryAction {
	public function __construct(ShowLibraryResponder $responder, ShowLibraryService $services) {
		$this->responder = $responder;
		$this->services = $services;
	}
	public function __invoke(Library $library) {
		return $this->responder->withResponse(
			$this->services->handle($library)
		)->respond();
	}
}