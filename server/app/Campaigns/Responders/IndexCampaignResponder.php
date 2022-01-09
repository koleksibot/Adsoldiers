<?php

namespace App\Campaigns\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Campaigns\Domain\Resources\CampaignResource;
use App\Campaigns\Domain\Resources\CampaignResourceCollection;

class IndexCampaignResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        if ($this->response['status'] != 200) {
            return response()->json($this->response['data'], $this->response['status']);
        }

        $this->response['data'] =  (new CampaignResourceCollection($this->response['data']));

        return $this->response;
    }
}
