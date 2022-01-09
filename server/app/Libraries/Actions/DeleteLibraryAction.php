<?php

namespace App\Libraries\Actions;

use App\Libraries\Domain\Services\DeleteLibraryService;
use App\Libraries\Responders\DeleteLibraryResponder;

class DeleteLibraryAction 
{
    public function __construct(DeleteLibraryResponder $responder, DeleteLibraryService $services) 
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