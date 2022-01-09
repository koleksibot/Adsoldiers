<?php

namespace App\Users\Actions;

use App\Users\Responders\UpdateProfileResponder;
use App\Users\Domain\Services\UpdateProfileService;
use App\Users\Domain\Requests\UpdateUserFormRequest;

class UpdateProfileAction
{
    public function __construct(UpdateProfileResponder $responder, UpdateProfileService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }

    public function __invoke(UpdateUserFormRequest $request)
    {
        return $this->responder->withResponse(
            $this->services->handle($request->validated())
        )->respond();
    }
}
