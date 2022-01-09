<?php

namespace App\Ads\Responders;

use App\Ads\Domain\Resources\AdResourceCollection;
use App\App\Responders\Responder;

class IndexAdResponder extends Responder
{
    public function respond()
    {
        // if ($this->response['status'] != 200) {
        //     return response()->json($this->response['data'], $this->response['status']);
        // }

        $this->response['data'] = (new AdResourceCollection($this->response['data']))->new((['test' => 't']));

        return $this->response;
    }
}
