<?php

namespace App\Ads\Actions;

use App\Ads\Domain\Services\IndexCountriesService;
use App\Ads\Responders\IndexCountriesResponder;

class IndexCountriesAction
{
    public function __construct(IndexCountriesResponder $responder, IndexCountriesService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke()
    {
        return $this->responder->withResponse(
            $this->services->handle()
        )->respond();
    }
}
