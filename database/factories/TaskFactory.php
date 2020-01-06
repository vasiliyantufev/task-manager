<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use App\User;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->name,
        'status' => random_int(0, 1),
        'creator_id' => User::all()->random(),
        'executor_id' => User::all()->random(),
    ];
});
