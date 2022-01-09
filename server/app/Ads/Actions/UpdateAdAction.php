<?php

namespace App\Ads\Actions;

use App\Ads\Domain\Models\Ad;
use App\Ads\Domain\Services\UpdateAdService;
use App\Ads\Responders\UpdateAdResponder;
use App\Campaigns\Domain\Requests\UpdateAdFormRequest;

class UpdateAdAction
{
    public function __construct(UpdateAdResponder $responder, UpdateAdService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(UpdateAdFormRequest $request, Ad $ad)
    {
        return $this->responder->withResponse(
            $this->services->handle($request->validated(), $ad)
        )->respond();
    }
}
