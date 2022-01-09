<?php

namespace App\PaymentMethods\Actions;

use App\PaymentMethods\Domain\Services\DecryptBayanPayService;
use App\PaymentMethods\Responders\DecryptBayanPayResponder;
use Illuminate\Http\Request;

class DecryptBayanPayAction
{
    public function __construct(DecryptBayanPayResponder $responder, DecryptBayanPayService $services)
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
