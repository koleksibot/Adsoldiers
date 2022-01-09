<?php

namespace App\Payment\Sahred\Actions;

use App\Payment\Sahred\Responders\IndexUserBalanceResponder;
use App\Payment\Sahred\Domain\Services\IndexUserBalanceService;

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
