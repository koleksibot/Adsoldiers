<?php

namespace App\Payment\Advertiser\Actions;

use App\Payment\Advertiser\Responder\StoreTransactionResponder;
use App\Payment\Advertiser\Domain\Services\StoreTransactionService;
use App\Payment\Advertiser\Domain\Requests\StoreTransactionFormRequest;

class StoreTransactionAction
{
    public function __construct(StoreTransactionResponder $responder, StoreTransactionService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }

    public function __invoke(StoreTransactionFormRequest $request)
    {
        return $this->responder->withResponse(
            $this->services->handle($request->validated())
        )->respond();
    }
}
