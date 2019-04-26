<?php

$factory->define(App\CleaningType::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "external_id" => $faker->randomNumber(2),
    ];
});
