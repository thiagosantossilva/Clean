<?php

$factory->define(App\CleaningStatus::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
