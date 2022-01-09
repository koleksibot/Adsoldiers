<?php

namespace App\Ads\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;

class CreateAdResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        if ($this->response['status'] != 200) {
            return response()->json($this->response['data'], $this->response['status']);
        }
        return $this->response;
    }
}
