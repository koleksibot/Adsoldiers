<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Settings\Domain\Models\Setting;
use Faker\Generator as Faker;

$factory->define(Setting::class, function (Faker $faker) {
    return [
        'about_us' => $faker->paragraph,
        'about_us_image' => 'about1.jpg',
        'mission' => $faker->paragraph,
        'mission_image' => 'about2.jpg',
        'vision' => $faker->paragraph,
        'vision_image' => 'about3.jpg',
        'terms' => $faker->paragraph,
        'privacy' => $faker->paragraph,
        'email' => 'info@adsoldier.com',
        'mobile' => '+95544785445',
        'facebook' => 'https://www.facebook.com/',
        'twitter' => 'https://www.twitter.com/',
        'instagram' => 'https://www.instagram.com/',
        'address' => 'address goes here',
        'lng' => '31.1635441',
        'lat' => '29.9883297',
        'intro_video' => "https://www.youtube.com/embed/yRAzlw4JM8o",
        'campaign_min_Duration' => '5',
        'campaign_min_budget' => '50',
        'ad_min_budget' => '10',
    ];
});
