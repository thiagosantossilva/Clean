<?php

$factory->define(App\Client::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "email" => $faker->safeEmail,
        "external_id" => $faker->randomNumber(2),
        "cpf" => $faker->name,
        "birthdate" => $faker->date("d/m/Y", $max = 'now'),
        "gender" => $faker->name,
        "phone" => $faker->name,
        "celphone" => $faker->name,
        "street" => $faker->name,
        "number" => $faker->randomNumber(2),
        "zip" => $faker->name,
        "neighborhood" => $faker->name,
        "city" => $faker->name,
        "state" => $faker->name,
        "complement" => $faker->name,
    ];
});
