<?php

namespace App\Contact\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;

class StoreContactMessageResponder extends Responder implements ResponderInterface {
	public function respond() {
		if ($this->response['status'] != 200) {
			return $this->response;
		}

		return response()->json([
			'message' => 'Thanks ' . $this->response['data']->name . ' your message Has been sent.',
		]);
	}
}
