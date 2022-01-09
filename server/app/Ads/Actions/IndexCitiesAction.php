<?php

namespace App\Ads\Actions;

use App\Ads\Domain\Services\IndexCitiesService;
use App\Ads\Responders\IndexCitiesResponder;

class IndexCitiesAction
{
    public function __construct(IndexCitiesResponder $responder, IndexCitiesService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke($country_id)
    {
        return $this->responder->withResponse(
            $this->services->handle($country_id)
        )->respond();
    }
}
