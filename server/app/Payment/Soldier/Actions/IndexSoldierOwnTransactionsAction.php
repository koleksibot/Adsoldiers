<?php

namespace App\Payment\Soldier\Actions;

use App\Payment\Soldier\Responders\IndexSoldierOwnTransactionsResponder;
use App\Payment\Soldier\Domain\Services\IndexSoldierOwnTransactionsService;

class IndexSoldierOwnTransactionsAction
{
    public function __construct(IndexSoldierOwnTransactionsResponder $responder, IndexSoldierOwnTransactionsService $services)
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
