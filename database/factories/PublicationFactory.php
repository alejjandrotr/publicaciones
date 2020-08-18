<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Publication;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$factory->define(Publication::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' =>'<p>'. $faker->realText(2000,  5) . '</p> <p>' .  $faker->realText(500,  2)  . '</p> <p>' . $faker->realText(100,  2) .' ...</p>',
       
    ];
});
