<?php

namespace App\Notifications\Actions;

use App\Notifications\Responders\ReadNotificationResponder;
use App\App\Domain\Notifications\Models\DatabaseNotification;
use App\Notifications\Domain\Services\ReadNotificationService;

class ReadNotificationAction
{
    public function __construct(ReadNotificationResponder $responder, ReadNotificationService $services)
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
