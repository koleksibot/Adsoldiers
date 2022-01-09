<?php

namespace App\PaymentMethods\Actions;

use App\PaymentMethods\Domain\Services\IndexUserBalanceService;
use App\PaymentMethods\Responders\IndexUserBalanceResponder;

class IndexUserBalanceAction 
{
    public function __construct(IndexUserBalanceResponder $responder, IndexUserBalanceService $services) 
    {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke() 
    {
        return $this->responder->withResponse(
            $this->services->handle()
        )->respond();
    }
}