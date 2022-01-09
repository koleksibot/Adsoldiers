<?php

namespace App\Analytics\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Analytics\Domain\Resources\ShowAnalyticsResource;

class ShowCampaignAnalyticResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        if ($this->response['status'] == 200) {
            $this->response['data'] = new ShowAnalyticsResource($this->response['data']);
        }

        return response()->json($this->response, $this->response['status']);
    }
}
