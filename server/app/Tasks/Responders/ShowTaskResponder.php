<?php

namespace App\Tasks\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Tasks\Domain\Resources\AdminTaskResource;
use App\Tasks\Domain\Resources\TaskResource;

class ShowTaskResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        $this->response['data'] = new TaskResource($this->response['data']);

        return $this->response;
    }
}
