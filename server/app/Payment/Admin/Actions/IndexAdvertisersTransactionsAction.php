<?php

namespace App\Payment\Admin\Actions;

use App\Payment\Admin\Responders\IndexAdvertisersTransactionsResponder;
use App\Payment\Admin\Domain\Services\IndexAdvertisersTransactionsService;

class IndexAdvertisersTransactionsAction
{
    public function __construct(IndexAdvertisersTransactionsResponder $responder, IndexAdvertisersTransactionsService $services)
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
