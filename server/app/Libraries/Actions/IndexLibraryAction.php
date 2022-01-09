<?php

namespace App\Libraries\Actions;

use App\Libraries\Domain\Services\IndexLibraryService;
use App\Libraries\Responders\IndexLibraryResponder;

class IndexLibraryAction 
{
    public function __construct(IndexLibraryResponder $responder, IndexLibraryService $services) 
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