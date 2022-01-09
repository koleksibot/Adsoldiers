<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Analytics\Domain\Models\StatsCountry;

$factory->define(StatsCountry::class, function (Faker $faker) {
    return [
        'value' => 'Country Dummy',
    ];
});
