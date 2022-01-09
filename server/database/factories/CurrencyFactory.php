<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ads\Domain\Models\Currency;
use Faker\Generator as Faker;

$factory->define(Currency::class, function (Faker $faker) {
    return [
        'currency_name' => 'ريال سعودي ',
        'currency_name_en' => 'Saudi Arabian Reyal',
        'iso4217_alpha3' => 'SAR',
        'iso4217_num3' => '682',

    ];
});

$factory->state(Currency::class, 'usd', function (Faker $faker) {
    return [
        'currency_name' => 'US Dollar',
        'currency_name_en' => 'US Dollar',
        'iso4217_alpha3' => 'USD',
        'iso4217_num3' => '840',

    ];
});
