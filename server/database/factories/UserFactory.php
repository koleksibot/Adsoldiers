<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Users\Domain\Models\Company;
use App\Users\Domain\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
 */

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $faker->unique()->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$RwtFG9afi8UzoU1UQ/GkFu8nmM1c88q9/ZJpsSDhbKrBqqSuE/Qjm', // password
        'tasks_lvl' => "1",
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
$factory->afterCreatingState(User::class, 'with-activation', function ($user) {
    $user->activation()->create([
        'token' => Str::random(32),
    ]);
});

$factory->state(User::class, 'with-company', function ($faker) {
    return [
        'company_id' => function () {
            return factory(Company::class)->create()->id;
        },
    ];
});
