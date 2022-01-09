<?php

namespace App\Payment\Advertiser\Actions;

use App\Payment\Advertiser\Responder\IndexAdvertiserOwnTransactionsResponder;
use App\Payment\Advertiser\Domain\Services\IndexAdvertiserOwnTransactionsService;

class IndexAdvertiserOwnTransactionsAction
{
    public function __construct(IndexAdvertiserOwnTransactionsResponder $responder, IndexAdvertiserOwnTransactionsService $services)
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
