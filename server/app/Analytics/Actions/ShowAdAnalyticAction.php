<?php

namespace App\Analytics\Actions;

use App\Ads\Domain\Models\Ad;
use App\Analytics\Responders\ShowAdAnalyticResponder;
use App\Analytics\Domain\Services\ShowAdAnalyticService;

class ShowAdAnalyticAction
{
    public function __construct(ShowAdAnalyticResponder $responder, ShowAdAnalyticService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }

    public function __invoke(Ad $ad)
    {
        return $this->responder->withResponse(
            $this->services->handle($ad)
        )->respond();
    }
}
