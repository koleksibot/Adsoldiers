<?php

namespace App\Payment\Advertiser\Actions;

use App\Payment\Advertiser\Responder\ShowHyperPayTransactionStatusResponder;
use App\Payment\Advertiser\Domain\Services\ShowHyperPayTransactionStatusService;
use App\Payment\Advertiser\Domain\Requests\ShowHyperPayTransactionStatusFormRequest;

class ShowHyperPayTransactionStatusAction
{
    public function __construct(ShowHyperPayTransactionStatusResponder $responder, ShowHyperPayTransactionStatusService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(ShowHyperPayTransactionStatusFormRequest $request)
    {
        return $this->responder->withResponse(
            $this->services->handle($request->validated())
        )->respond();
    }
}
