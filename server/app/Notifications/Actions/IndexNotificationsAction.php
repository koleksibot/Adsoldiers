<?php

namespace App\Notifications\Actions;

use App\Notifications\Responders\IndexNotificationsResponder;
use App\Notifications\Domain\Services\IndexNotificationsService;

class IndexNotificationsAction
{
    public function __construct(IndexNotificationsResponder $responder, IndexNotificationsService $services)
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
