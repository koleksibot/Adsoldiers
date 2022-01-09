<?php

use App\Users\Domain\Models\Reminder;
use App\Users\Domain\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Reminder::class, function (Faker $faker) {
    return [
        'token' => Str::random(32),
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
    ];
});

$factory->state(Reminder::class, 'completed', function ($faker) {
    return [
        'completed_at' => now(),
    ];
});
