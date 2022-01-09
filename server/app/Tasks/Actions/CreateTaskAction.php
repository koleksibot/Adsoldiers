<?php

namespace App\Tasks\Actions;

use App\Tasks\Domain\Requests\TaskFormRequest;
use App\Tasks\Domain\Services\CreateTaskService;
use App\Tasks\Responders\CreateTaskResponder;

class CreateTaskAction
{
    public function __construct(CreateTaskResponder $responder, CreateTaskService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(TaskFormRequest $request)
    {
        return $this->responder->withResponse(
            $this->services->handle($request->validated())
        )->respond();
    }
}
