<?php

namespace App\Tasks\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Tasks\Domain\Resources\TaskResourceCollection;

class IndexTasksResponder extends Responder
{
    public function respond()
    {
        return response()->json($this->response, $this->response['status']);
    }
}
