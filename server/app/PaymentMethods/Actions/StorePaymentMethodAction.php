<?php

namespace App\PaymentMethods\Actions;

use App\PaymentMethods\Domain\Requests\StorePaymentMethodRequest;
use App\PaymentMethods\Domain\Services\StorePaymentMethodService;
use App\PaymentMethods\Responders\StorePaymentMethodResponder;

class StorePaymentMethodAction
{
    public function __construct(StorePaymentMethodResponder $responder, StorePaymentMethodService $services)
    {

        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(StorePaymentMethodRequest $request)
    {
        return $this->responder->withResponse(
            $this->services->handle($request->validated())
        )->respond();
    }
}
