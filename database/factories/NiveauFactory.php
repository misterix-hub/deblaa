<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Niveau;
use Faker\Generator as Faker;

$factory->define(Niveau::class, function (Faker $faker) {

    return [
        'nom' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
