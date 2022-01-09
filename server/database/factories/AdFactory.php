<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ads\Domain\Models\Ad;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

// use Illuminate\Support\Str;

$factory->define(Ad::class, function (Faker $faker) {
    return [
        'title' => $title = $faker->word,
        'content' => $faker->text,
        'language' => [DB::table('languages')->inRandomOrder()->first()->value],
        'country' => [DB::table('countries')->inRandomOrder()->first()->country],
        'city' => [DB::table('cities')->inRandomOrder()->first()->city],
        'start_date' => now()->format('Y-m-d'),
        'end_date' => now()->format('Y-m-d'),
        'budget' => $budget = $faker->randomNumber(),
        'remaining_budget' => $budget - 100,
        'media' => $media = $faker->randomElement(
            $arrray = [
                ['videos/XKTNfPMikiF4PKn5XIfSmBrglHhav4644NZ2b4w4.mp4'],
                ['img/9NLX91evBUR3jyOKeDtT5DR6DKFRrCsVaPHOtA9O.jpeg'],
            ]
        ),
        'age' => [$faker->randomElement($array = ['25-34', '35-44', '45-54'])],
        'gender' => $faker->randomElement($array = ['male', 'female']),
        'targeted_audience' => [
            'Banking & Finance/Avid Investors',
            'Sports & Fitness/Sports Fans'
        ],
        'call_of_action_url' => 'https://www.youtube.com/',
        'call_of_action_txt' => 'Take Me to Main Page',
        'media_type' => strpos(HEAD($media), 'img/') !== false ? 'image' : 'video',
        'campaign_id' => 1,
        'advertiser_id' => 2,
    ];
});
