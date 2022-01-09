<?php

namespace App\Payment\Admin\Actions;

use App\Payment\Domain\Models\SoldierTransaction;
use App\Payment\Admin\Responder\ConvertTransactionToDoneResponder;
use App\Payment\Admin\Domain\Services\ConvertTransactionToDoneService;
use App\Payment\Admin\Domain\Requests\ConvertTransactionToDoneFormRequest;

class ConvertTransactionToDoneAction
{
    public function __construct(ConvertTransactionToDoneResponder $responder, ConvertTransactionToDoneService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }

    public function __invoke(ConvertTransactionToDoneFormRequest $request, SoldierTransaction $transaction)
    {
        return $this->responder->withResponse(
            $this->services->handle($request->validated(), $transaction)
        )->respond();
    }
}
