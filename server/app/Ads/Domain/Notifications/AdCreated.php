<?php

namespace App\Ads\Domain\Notifications;

use App\Ads\Domain\Models\Ad;
use Illuminate\Bus\Queueable;
use App\Tasks\Domain\Models\Task;
use App\App\Domain\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\App\Domain\Notifications\Channels\DatabaseChannel;

class AdCreated extends Notification
{
    use Queueable;

    public $ad;
    // public $task;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Ad $ad)
    {
        $this->ad = $ad;
        // $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [DatabaseChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed                                          $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->ad->id,
            'title' => $this->ad->title,
        ];
    }
}
