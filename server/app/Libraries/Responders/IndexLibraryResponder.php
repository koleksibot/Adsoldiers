<?php

namespace App\Libraries\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;

class IndexLibraryResponder extends Responder implements ResponderInterface {
	public function respond() {
		return $this->response;
	}
}
