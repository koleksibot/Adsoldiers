<?php
namespace App\Campaigns\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Campaigns\Domain\Resources\CampaignResource;

class ShowCampaignResponder extends Responder
{
    public function respond()
    {
        $this->response['data'] = new CampaignResource($this->response['data']);
        return $this->response;
    }
}
