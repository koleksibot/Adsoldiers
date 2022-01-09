<?php

namespace App\Analytics\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Analytics\Domain\Resources\ShowAnalyticsResource;

class ShowAdvertiserAnalyticResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        $this->response['data'] = new ShowAnalyticsResource($this->response['data']);
        return response()->json($this->response, $this->response['status']);
    }
}
