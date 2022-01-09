<?php

namespace App\Settings\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;

class IndexSettingsResponder extends Responder implements ResponderInterface {
	public function respond() {
		return $this->response;
	}
}
