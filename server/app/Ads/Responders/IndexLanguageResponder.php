<?php

namespace App\Ads\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;

class IndexLanguageResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
             return  $this->response;
    }
}
