<?php

$factory->define(App\AddressType::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
