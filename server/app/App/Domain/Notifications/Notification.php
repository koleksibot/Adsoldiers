<?php

namespace App\App\Domain\Notifications;

use ReflectionClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification as BaseNotification;

class Notification extends BaseNotification
{
    public function models()
    {
        // pullout the info form current notification
        $reflection = new ReflectionClass($this);

        $params = $reflection->getConstructor()->getParameters();

        return array_map(function ($param) {
            // get parameter's class
            $class = $param->getClass();

            // if the main class not model then reutrn
            if (!$class->isSubclassOf(Model::class)) {
                return;
            }

            // return the parameter id and name
            return [
                'id' => $this->{$param->name}->id,
                'class' => $class->name
            ];
        }, $params);
    }
}
