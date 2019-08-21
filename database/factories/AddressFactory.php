<?php

use App\Models\Address;
use App\Models\User;
use Carbon\Carbon;
use Faker\Generator;

/**
 * @var Illuminate\Database\Eloquent\Factory $factory
 */
$factory->define(Address::class, function (Generator $faker) {
    return [
        "name" => "{$faker->firstName} {$faker->lastName}",
        "line1" => $faker->streetAddress,
        "line2" => $faker->userName,
        "postal_code" => $faker->postcode,
        "city" => $faker->city,
        "country" => "France",
        "user_id" => User::random()->id,
        "created_at" => Carbon::now(),
        "updated_at" => Carbon::now()
    ];
});
