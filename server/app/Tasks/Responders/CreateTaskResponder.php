<?php

namespace App\Tasks\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;

class CreateTaskResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        return response()->json($this->response, $this->response['status']);
    }
}
