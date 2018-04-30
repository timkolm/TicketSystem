<?php

//use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Ticket::class, function (Faker\Generator $faker) {
  return [
    'user' => 'John Doe',
    'subject' => $faker->sentence(4, true),
    'description' => $faker->text(300),
    'urgency' => $faker->randomElement(['Very urgent', 'Urgent', 'Average urgency', 'Not urgent']),
    'status' => $faker->randomElement(['Open', 'Responded']),
  ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
  return [
    'user' => $faker->randomElement(['John Doe', 'Admin']),
    'body' => $faker->text(150),
    'ticket_id' => $faker->numberBetween(10,29),
  ];
});
