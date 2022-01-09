<?php

namespace App\Payment\Admin\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;

class IndexAdvertisersTransactionsResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        return response()->json($this->response, $this->response['status']);
    }
}
