<?php

namespace App\Ads\Actions;

use App\Ads\Domain\Models\Ad;
use App\Ads\Responders\ActivateAdResponder;
use App\Ads\Domain\Services\ActivateAdService;

class ActivateAdAction
{
    public function __construct(ActivateAdResponder $responder, ActivateAdService $services)
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
