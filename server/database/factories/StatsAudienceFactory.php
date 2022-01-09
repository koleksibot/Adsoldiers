<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Analytics\Domain\Models\StatsAudience;

$factory->define(StatsAudience::class, function (Faker $faker) {
    return [
        'value' => 'audience test',
    ];
});
