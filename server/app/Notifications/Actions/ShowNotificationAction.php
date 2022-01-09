<?php

namespace App\Notifications\Actions;

use App\App\Domain\Notifications\Models\DatabaseNotification;
use App\Notifications\Domain\Services\ShowNotificationService;
use App\Notifications\Responders\ShowNotificationResponder;

class ShowNotificationAction
{
    public function __construct(ShowNotificationResponder $responder, ShowNotificationService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }

    public function __invoke(DatabaseNotification $notification)
    {
        return $this->responder->withResponse(
            $this->services->handle($notification)
        )->respond();
    }
}
