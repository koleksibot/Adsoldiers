<?php

namespace App\Libraries\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;

class ShowLibraryService extends Service {
	public function handle($library = null) {
		return new GenericPayload($library);
	}
}