<?php

namespace App\Users\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Users\Domain\Resources\UserResource;

class IndexUsersResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        $this->response['data'] = UserResource::collection($this->response['data']);
        return $this->response;
    }
}
