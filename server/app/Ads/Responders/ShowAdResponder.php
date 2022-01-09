<?php

namespace App\Ads\Responders;

use App\Ads\Domain\Resources\AdResource;
use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;

class ShowAdResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        $this->response['data'] = (new AdResource($this->response['data']));
        return $this->response;
    }
}
