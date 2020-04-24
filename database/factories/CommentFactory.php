<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {

    return [
        'content' => $faker->text,
        'parent_id' => null
    ];
});

$factory->state(Comment::class, 'parent', function (Faker $faker) {
    return [
        'parent_id' => Comment::count()
            ? Comment::all()->random(1)->first()->id
            : null
    ];
});
