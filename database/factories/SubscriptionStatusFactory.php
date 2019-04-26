<?php

$factory->define(App\SubscriptionStatus::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
