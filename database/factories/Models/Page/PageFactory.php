<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

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

$factory->define(\Domain\Entities\Page\Page::class, function (Faker $faker) {
    return [
        'user_id' => factory(\Domain\Entities\User\User::class)->create()->id,
        'name' => $faker->name,
        'slug' => $faker->name,
        'content' => $faker->paragraph(10),
    ];
});
