<?php

namespace App\Ads\Actions;

use App\Ads\Domain\Models\Ad;
use App\Ads\Responders\SubscribeAdResponder;
use App\Ads\Domain\Services\SubscribeAdService;

class SubscribeAdAction
{
    public function __construct(SubscribeAdResponder $responder, SubscribeAdService $services)
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
