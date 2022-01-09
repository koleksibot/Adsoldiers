<?php

namespace App\PaymentMethods\Actions;

use App\Contact\Domain\Requests\EncryptPaymentFormRequest;
use App\PaymentMethods\Responders\EncryptPaymentFormResponder;
use App\PaymentMethods\Domain\Services\EncryptPaymentFormService;

class EncryptPaymentFormAction
{
    public function __construct(EncryptPaymentFormResponder $responder, EncryptPaymentFormService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }

    public function __invoke(EncryptPaymentFormRequest $request)
    {
        return $this->responder->withResponse(
            $this->services->handle($request->validated())
        )->respond();
    }
}
