<?php

namespace App\Ads\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;

class UpdateAdResponder extends Responder implements ResponderInterface {
	public function respond() {
		return $this->response;
	}
}
