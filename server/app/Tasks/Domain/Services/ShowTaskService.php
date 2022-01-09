<?php

namespace App\Tasks\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;

class ShowTaskService extends Service {
	public function handle($task = null) {
		return new GenericPayload($task);
	}
}