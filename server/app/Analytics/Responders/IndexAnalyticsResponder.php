<?php

namespace App\Analytics\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;

class IndexAnalyticsResponder extends Responder implements ResponderInterface {
	public function respond() {
		return $this->response;
	}
}
