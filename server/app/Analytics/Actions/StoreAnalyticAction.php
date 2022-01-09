<?php

namespace App\Analytics\Actions;

use App\Analytics\Responders\StoreAnalyticResponder;
use App\Analytics\Domain\Requests\AnalyticFormRequest;
use App\Analytics\Domain\Services\StoreAnalyticService;

class StoreAnalyticAction
{
    public function __construct(StoreAnalyticResponder $responder, StoreAnalyticService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }

    public function __invoke(AnalyticFormRequest $request)
    {
        return $this->responder->withResponse(
            $this->services->handle($request->validated())
        )->respond();
    }
}
