<?php

namespace App\Analytics\Actions;

use App\Analytics\Domain\Services\IndexAnalyticsService;
use App\Analytics\Responders\IndexAnalyticsResponder;

class IndexAnalyticsAction
{
    public function __construct(IndexAnalyticsResponder $responder, IndexAnalyticsService $services)
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
