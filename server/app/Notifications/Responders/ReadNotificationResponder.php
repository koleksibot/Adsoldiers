<?php

namespace App\Notifications\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;

class ReadNotificationResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        return response()->json($this->response['data'], $this->response['status']);
    }
}
