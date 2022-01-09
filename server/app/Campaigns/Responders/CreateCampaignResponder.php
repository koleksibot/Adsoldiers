<?php

namespace App\Campaigns\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;

class CreateCampaignResponder extends Responder
{
    public function respond()
    {
        return response()->json($this->response, $this->response['status']);
    }
}
