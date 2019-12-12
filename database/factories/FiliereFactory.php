<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Filiere;
use Faker\Generator as Faker;

$factory->define(Filiere::class, function (Faker $faker) {

    return [
        'nom' => $faker->word,
        'universite_id' => $faker->randomDigitNotNull,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
