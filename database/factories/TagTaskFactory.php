<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TagTask;
use App\Tag;
use App\Task;
use Faker\Generator as Faker;

$factory->define(TagTask::class, function (Faker $faker) {
    return [
        'task_id' => Task::all()->random(),
        'tag_id' => Tag::all()->random(),
    ];
});
