<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Propriedade;
use Faker\Generator as Faker;


$factory->define(Propriedade::class, function (Faker $faker) {
    return [
        'email_prop' => $faker->name,
        'rua' => $faker->streetName,
        'numero' => $faker->randomDigit,
        'complemento' => $faker->secondaryAddress, // password
        'bairro' => $faker->streetSuffix,
        'cidade' => $faker->city,
        'estado' => $faker->stateAbbr,
        'status' => $faker->randomLetter,
    ];
});