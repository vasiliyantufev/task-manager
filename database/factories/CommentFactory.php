<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Task;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        //
        'text' => $faker->name,
        'creator_id' => User::all()->random(),
        'task_id' => Task::all()->random(),
        'status' => random_int(1, 2),
    ];
});
