<?php

namespace App\Payment\Shared\Actions;

use App\Payment\Domain\Models\SoldierTransaction;
use App\Payment\Shared\Responder\CancelTransactionResponder;
use App\Payment\Shared\Domain\Services\CancelTransactionService;

class CancelTransactionAction
{
    public function __construct(CancelTransactionResponder $responder, CancelTransactionService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }

    public function __invoke(SoldierTransaction $transaction)
    {
        return $this->responder->withResponse(
            $this->services->handle($transaction)
        )->respond();
    }
}
