<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Universite;
use Faker\Generator as Faker;

$factory->define(Universite::class, function (Faker $faker) {

    return [
        'nom' => $faker->word,
        'sigle' => $faker->word,
        'logo' => $faker->word,
        'telephone' => $faker->word,
        'email' => $faker->word,
        'password' => $faker->word,
        'site_web' => $faker->word,
        'acces' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
