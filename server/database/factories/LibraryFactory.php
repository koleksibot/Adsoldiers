<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Libraries\Domain\Models\Library;
use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Library::class, function (Faker $faker) {
    return [
        'title' => $faker->word(),
        'description' => $faker->sentence(5),
        'media' => $media = $faker->randomElement(
            array(
                [
                    "img/9NLX91evBUR3jyOKeDtT5DR6DKFRrCsVaPHOtA9O.jpeg",
                    "img/s.jpeg"
                ],
                [
                    "img/s.jpeg"
                ],
                [
                    "videos/XKTNfPMikiF4PKn5XIfSmBrglHhav4644NZ2b4w4.mp4"
                ],
            )
        ),
        'media_type' => Str::is('img/*', $media[0]) ? 'image' : 'video',
    ];
});
