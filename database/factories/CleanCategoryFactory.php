<?php

$factory->define(App\CleanCategory::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
