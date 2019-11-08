<?php

use Illuminate\Support\Carbon;

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
        'name' => $faker->name,
        'email' => $faker->email,
        'api_token' => 'test-token'
    ];
});

$factory->define(App\Attendee::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->define(App\Staff::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->define(App\Location::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->define(App\Service::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->define(App\Appointment::class, function(Faker\Generator $faker) {
    return [
        'attendee_id' => function() {
            return factory(App\User::class)->create()->id;
        },
        'staff_id' => function() {
            return factory(App\Staff::class)->create()->id;
        },
        'location_id' => function() {
            return factory(App\Location::class)->create()->id;
        },
        'service_id' => function() {
            return factory(App\Service::class)->create()->id;
        },
        'start' => Carbon::now(),
        'end' => Carbon::now()->addMinutes(10),
    ];
});
