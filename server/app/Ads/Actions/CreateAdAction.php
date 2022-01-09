<?php

namespace App\Ads\Actions;

use App\Ads\Domain\Requests\CreateAdFormRequest;
use App\Ads\Domain\Services\CreateAdService;
use App\Ads\Responders\CreateAdResponder;

class CreateAdAction
{
    public function __construct(CreateAdResponder $responder, CreateAdService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(CreateAdFormRequest $request)
    {
        return $this->responder->withResponse(
            $this->services->handle($request->validated())
        )->respond();
    }
}
