<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\PaymentMethods\Domain\Models\PaymentMethod::class, function (Faker $faker) {
    return [
        'card_type' => 'Visa',
        'last_four' => '4242',
        'provider_id' => Str::random(10),
    ];
});
