<?php

$factory->define(App\CleansFeedback::class, function (Faker\Generator $faker) {
    return [
        "clean_id" => factory('App\Clean')->create(),
        "text" => $faker->name,
    ];
});
