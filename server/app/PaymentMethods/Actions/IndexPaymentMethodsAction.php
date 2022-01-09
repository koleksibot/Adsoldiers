<?php

namespace App\PaymentMethods\Actions;

use App\PaymentMethods\Domain\Services\IndexPaymentMethodsService;
use App\PaymentMethods\Responders\IndexPaymentMethodsResponder;
use Illuminate\Http\Request;

class IndexPaymentMethodsAction
{
    public function __construct(IndexPaymentMethodsResponder $responder, IndexPaymentMethodsService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(Request $request)
    {
        return $this->responder->withResponse(
            $this->services->handle($request)
        )->respond();
    }
}
