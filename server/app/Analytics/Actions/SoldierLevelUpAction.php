<?php

namespace App\Analytics\Actions;

use App\Analytics\Domain\Services\SoldierLevelUpService;
use App\Analytics\Responders\SoldierLevelUpResponder;

class SoldierLevelUpAction
{
    public function __construct(SoldierLevelUpResponder $responder, SoldierLevelUpService $services)
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
