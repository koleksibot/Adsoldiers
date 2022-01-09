<?php

namespace App\Payment\Soldier\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;

class IndexSoldierOwnTransactionsResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        return response()->json($this->response, $this->response['status']);
    }
}
