<?php

namespace App\Analytics\Actions;

use App\Analytics\Responders\ShowSoldierAnalyticResponder;
use App\Analytics\Domain\Services\ShowSoldierAnalyticService;

class ShowSoldierAnalyticAction
{
    public function __construct(ShowSoldierAnalyticResponder $responder, ShowSoldierAnalyticService $services)
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
