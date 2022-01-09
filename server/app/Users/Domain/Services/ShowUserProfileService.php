<?php

namespace App\Users\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;

class ShowUserProfileService extends Service {
	public function handle($user = null) {
		return new GenericPayload($user);
	}
}