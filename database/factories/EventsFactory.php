<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(\App\Model\Event::class, function (Faker $faker) {

    $start_date = $faker->dateTimeBetween('this week', '+6 days');

    return [
        'title' => $faker->sentence(rand(3, 9)),
        'description' => $faker->text,
        'starts_at' => $start_date,
        'ends_at' => $faker->dateTimeBetween($start_date, strtotime('+6 days'))
    ];
});


