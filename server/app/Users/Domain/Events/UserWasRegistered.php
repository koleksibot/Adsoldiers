<?php

namespace App\Users\Domain\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserWasRegistered
{
    use Dispatchable, SerializesModels;

    public $user;
    public $activation;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $activation)
    {
        $this->user = $user;
        $this->activation = $activation;
    }
}
