<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Users\Domain\Models\Company;
use App\Users\Domain\Models\User;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        // 'user_id' => function () {
        //     return factory(User::class)->create()->id;
        // },
        'name' => $faker->unique()->word,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
