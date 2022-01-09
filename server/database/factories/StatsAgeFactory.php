<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Analytics\Domain\Models\StatsAge;

$factory->define(StatsAge::class, function (Faker $faker) {
    return [
        'value' => 15,
    ];
});
