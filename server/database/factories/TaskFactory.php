<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tasks\Domain\Models\Task;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->word(),
        'content' => $faker->paragraph(),
        'description' => $faker->paragraph(3),
        // 'media_type' => 'image',
        'type' => 'library',
    ];
});
