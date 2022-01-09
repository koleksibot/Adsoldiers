<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Campaigns\Domain\Models\Campaign;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Campaign::class, function (Faker $faker) {
    return [
        'company_id' => 2,
        'owner_id' => 2,
        'title' => $faker->unique()->sentence(2),
        'type' => $faker->randomElement(
            array(
                "app-installs",
                "awareness",
                "lead-generation",
                "messages",
                "traffic",
                "video-views"
            )
        )
    ];
});
