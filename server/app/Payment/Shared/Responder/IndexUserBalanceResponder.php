<?php

namespace App\Payment\Sahred\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;

class IndexUserBalanceResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        return response()->json($this->response, $this->response['status']);
    }
}
