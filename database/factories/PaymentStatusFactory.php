<?php

$factory->define(App\PaymentStatus::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
