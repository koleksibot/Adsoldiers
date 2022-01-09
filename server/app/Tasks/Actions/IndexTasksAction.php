<?php

namespace App\Tasks\Actions;

use App\Tasks\Domain\Services\IndexTasksService;
use App\Tasks\Responders\IndexTasksResponder;

class IndexTasksAction
{
    public function __construct(IndexTasksResponder $responder, IndexTasksService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke()
    {
        return $this->responder->withResponse(
            $this->services->handle(auth()->user())
        )->respond();
    }
}
