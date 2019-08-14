<?php

use App\Models\User;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

/**
 * @var Illuminate\Database\Eloquent\Factory $factory
 */
$factory->define(User::class, function (Generator $faker) {
    return [
        "email" => $faker->email,
        "password" => Cache::remember("hash-123456", 10, function () {
            return Hash::make("123456");
        }),
        "first_name" => $faker->firstName,
        "last_name" => $faker->lastName,
        "stripe_id" => "cus_" . substr($faker->uuid, 0, 8),
        "scopes" => [],
        "created_at" => Carbon::now(),
        "updated_at" => Carbon::now()
    ];
});
