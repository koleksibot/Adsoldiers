<?php

namespace App\Ads\Actions;

use App\Ads\Domain\Services\IndexAdService;
use App\Ads\Responders\IndexAdResponder;

class IndexAdAction
{
    public function __construct(IndexAdResponder $responder, IndexAdService $services)
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
