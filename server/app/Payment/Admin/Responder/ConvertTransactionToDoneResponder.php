<?php

namespace App\Payment\Admin\Responder;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Payment\Admin\Domain\Resources\TransactionResourceCollection;

class ConvertTransactionToDoneResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        if ($this->response['status'] != 200) {
            return response()->json($this->response['data'], $this->response['status']);
        }

        if (array_key_exists('transactions', $this->response['data'])) {
            $this->response['data']['transactions'] =  (new TransactionResourceCollection($this->response['data']['transactions']));
        }

        return $this->response;
    }
}
