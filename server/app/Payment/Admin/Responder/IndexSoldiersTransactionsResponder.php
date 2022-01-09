<?php

namespace App\Payment\Admin\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Payment\Admin\Domain\Resources\TransactionResourceCollection;

class IndexSoldiersTransactionsResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        if ($this->response['status'] != 200) {
            return response()->json($this->response['data'], $this->response['status']);
        }

        $this->response['data'] =  (new TransactionResourceCollection($this->response['data']));

        return $this->response;
    }
}
