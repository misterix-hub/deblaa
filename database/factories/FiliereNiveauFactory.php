<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\FiliereNiveau;
use Faker\Generator as Faker;

$factory->define(FiliereNiveau::class, function (Faker $faker) {

    return [
        'filiere_id' => $faker->randomDigitNotNull,
        'niveau_id' => $faker->randomDigitNotNull,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
