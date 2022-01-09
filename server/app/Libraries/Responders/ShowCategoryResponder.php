<?php

namespace App\Libraries\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Libraries\Domain\Resources\CategoryResource;

class ShowCategoryResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        if ($this->response['status'] != 200) {
            return response()->json($this->response['data'], $this->response['status']);
        }

        return (new CategoryResource($this->response['data']));
    }
}
