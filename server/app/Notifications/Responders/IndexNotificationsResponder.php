<?php

namespace App\Notifications\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Notifications\Domain\Resources\NotificationResourceCollection;

class IndexNotificationsResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        return response()->json(new NotificationResourceCollection($this->response['data']), $this->response['status']);
    }
}
