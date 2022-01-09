<?php

namespace App\Tasks\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;

class UpdateTaskResponder extends Responder implements ResponderInterface {
	public function respond() {
		return $this->response;
	}
}
