<?php

namespace App\Users\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;

class UserTutorialService extends Service
{
    public function handle($user = null)
    {
        // if user viewed the tutorial
        if ($user->tasks_lvl <= 1) {
            $tasks_lvl = $user->tasks_lvl + 1;
            $user->update(['tasks_lvl' => $tasks_lvl]);

            return new GenericPayload([
                'message' => 'Let\'s Move to the second Task and Share Library Content',
            ]);
        }
        // else
        return new GenericPayload([
            'message' => 'You Already Done This Task',
        ]);
    }
}
