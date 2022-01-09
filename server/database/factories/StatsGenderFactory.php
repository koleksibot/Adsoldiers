<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Analytics\Domain\Models\StatsGender;

$factory->define(StatsGender::class, function (Faker $faker) {
    return [
        'value' => 'male',
    ];
});
