<?php

namespace App\Notifications\Domain\Services;

use App\App\Domain\Services\Service;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Notifications\Models\DatabaseNotification;

class ReadNotificationService extends Service
{
    protected $message;

    public function handle($notification = [])
    {
        // if a notification has been read
        // if ($notification->read()) {
        // $this->message = 'Notification has already been read';
        // }

        //else read the notification
        $notification->markAsRead();
        // $notifications = DatabaseNotification::paginate(10);

        return new GenericPayload(DatabaseNotification::where([
            'notifiable_id' => auth()->user()->id
        ])
            ->orderBy('created_at', 'desc')
            ->paginate(5));
    }
}
