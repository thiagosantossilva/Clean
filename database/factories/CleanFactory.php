<?php

$factory->define(App\Clean::class, function (Faker\Generator $faker) {
    return [
        "external_id" => $faker->randomNumber(2),
        "payment_id" => $faker->randomNumber(2),
        "address_type_id" => factory('App\AddressType')->create(),
        "clean_type_id" => factory('App\CleaningType')->create(),
        "clean_category_id" => factory('App\CleanCategory')->create(),
        "client_id" => factory('App\Client')->create(),
        "status_id" => factory('App\CleaningStatus')->create(),
        "assigned_to_id" => factory('App\User')->create(),
        "qt_bedrooms" => $faker->randomNumber(2),
        "qt_bathrooms" => $faker->randomNumber(2),
        "additionals" => $faker->name,
        "total_time" => $faker->name,
        "products_included" => 1,
        "value" => $faker->randomNumber(2),
        "start_time" => $faker->date("d/m/Y H:i:s", $max = 'now'),
        "end_time" => $faker->date("d/m/Y H:i:s", $max = 'now'),
        "pet" => 0,
        "pet_cautions" => $faker->name,
    ];
});
