<?php

namespace App\Notifications\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;

class ShowNotificationService extends Service
{
    public function handle($notification = [])
    {
        return new GenericPayload($notification);
    }
}
