<?php

namespace App\Analytics\Actions;

use App\Analytics\Responders\ShowAdvertiserAnalyticResponder;
use App\Analytics\Domain\Requests\AnalyticFormRequest;
use App\Analytics\Domain\Services\ShowAdvertiserAnalyticService;

class ShowAdvertiserAnalyticAction
{
    public function __construct(ShowAdvertiserAnalyticResponder $responder, ShowAdvertiserAnalyticService $services)
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
