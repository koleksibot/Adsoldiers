<?php

namespace App\Payment\Advertiser\Responder;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;

class StoreTransactionResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        return response()->json($this->response, $this->response['status']);
    }
}
