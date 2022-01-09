<?php

namespace App\PaymentMethods\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Ads\Domain\Resources\EncryptPaymentFormResource;

class EncryptPaymentFormResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        if ($this->response['status'] == 200) {
            $this->response['data'] = (new EncryptPaymentFormResource($this->response['data']));
        }

        return response()->json($this->response, $this->response['status']);
    }
}
