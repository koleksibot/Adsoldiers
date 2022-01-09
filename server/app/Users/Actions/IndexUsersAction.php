<?php

namespace App\Users\Actions;

use App\Users\Domain\Services\IndexUsersService;
use App\Users\Responders\IndexUsersResponder;

class IndexUsersAction 
{
    public function __construct(IndexUsersResponder $responder, IndexUsersService $services) 
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