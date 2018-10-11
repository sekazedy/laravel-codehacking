<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'role_id' => $faker->numberBetween(1, 3),
        'is_active' => 1,
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'category_id' => $faker->numberBetween(1, 4),
        'photo_id' => 1,
        'title' => $faker->words(rand(1, 5), true),
        'body' => $faker->text,
        'slug' => $faker->slug,
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->randomElement(['administrator', 'author', 'subscriber']),
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->randomElement(['PHP', 'JS', 'MySQL', 'HTML']),
    ];
});

$factory->define(App\Photo::class, function (Faker\Generator $faker) {
    return [
        'file_path' => 'placeholder.jpg',
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'is_active' => 1,
        'author'    => $faker->name,
        'photo'     => '/images/placeholder.jpg',
        'email'     => $faker->safeEmail,
        'body'      => $faker->text,
    ];
});

$factory->define(App\CommentReply::class, function (Faker\Generator $faker) {
    return [
        'is_active' => 1,
        'author'    => $faker->name,
        'photo'     => '/images/placeholder.jpg',
        'email'     => $faker->safeEmail,
        'body'      => $faker->text,
    ];
});