<?php

namespace App\App\Domain\Notifications\Models;

use Illuminate\Notifications\DatabaseNotification as BaseDatabaseNotification;

class DatabaseNotification extends BaseDatabaseNotification
{
    public function getModelsAttribute($value)
    {
        return json_decode($value, true);
    }
}
