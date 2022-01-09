<?php

namespace App\Ads\Actions;

use App\Ads\Domain\Services\IndexLanguageService;
use App\Ads\Responders\IndexLanguageResponder;

class IndexLanguageAction 
{
    public function __construct(IndexLanguageResponder $responder, IndexLanguageService $services) 
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