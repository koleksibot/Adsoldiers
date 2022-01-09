<?php

namespace App\Users\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Users\Domain\Resources\UserResource;

class GetAuthenticatedUserResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        if ($this->response['status'] != 200) {
            return response()->json($this->response, $this->response['status']);
        }

        return (new UserResource($this->response['data']))
            ->additional(
                [
                    // store the response(token) in the token meta
                    'meta' => [
                        'token' => auth()->getToken()->get(),
                    ],
                ]
            );
    }
}
