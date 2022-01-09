<?php

namespace App\Payment\Admin\Actions;

use App\Payment\Admin\Responders\IndexSoldiersTransactionsResponder;
use App\Payment\Admin\Domain\Services\IndexSoldiersTransactionsService;

class IndexSoldiersTransactionsAction
{
    public function __construct(IndexSoldiersTransactionsResponder $responder, IndexSoldiersTransactionsService $services)
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
