<?php

namespace App\Users\Actions;

use App\Users\Domain\Models\User;
use App\Users\Domain\Services\UserTutorialService;
use App\Users\Responders\UserTutorialResponder;

class UserTutorialAction
{
    public function __construct(UserTutorialResponder $responder, UserTutorialService $services)
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
