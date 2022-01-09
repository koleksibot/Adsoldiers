<?php

namespace App\PaymentMethods\Actions;

use App\PaymentMethods\Domain\Services\CreateTransactionService;
use App\PaymentMethods\Responders\CreateTransactionResponder;

class CreateTransactionAction 
{
    public function __construct(CreateTransactionResponder $responder, CreateTransactionService $services) 
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