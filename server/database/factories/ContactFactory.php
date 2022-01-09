<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact\Domain\Models\Contact;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
         'name' => 'John Doe',
        'email' => 'johnDoe@gmail.com',
        'subject' => 'Interesting Subject',
        'message' => ' is a long established fact that a reader will be distracted by
         the readable content of a page when looking at its layout.
        The point of using Lorem Ipsum is that it has a more-or-less norma',
    ];
});
