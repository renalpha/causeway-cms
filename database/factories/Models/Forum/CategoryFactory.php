<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Carbon\Carbon;
use Faker\Generator as Faker;

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

$factory->define(\Domain\Entities\Forum\Category::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'slug' => $faker->name,
        'description' => $faker->paragraph,
    ];
});
