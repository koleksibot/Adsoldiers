<?php

namespace App\Notifications\Domain\Services;

use App\App\Domain\Services\Service;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Notifications\Models\DatabaseNotification;

class IndexNotificationsService extends Service
{
    public function handle($data = [])
    {
        return new GenericPayload(
            DatabaseNotification::where([
                'notifiable_id' => auth()->user()->id
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(5)
        );
    }
}
