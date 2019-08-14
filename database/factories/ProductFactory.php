<?php

use App\Models\Product;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Support\Str;

/**
 * @var Illuminate\Database\Eloquent\Factory $factory
 */
$factory->define(Product::class, function (Generator $faker) {
    $username = $faker->userName;

    return [
        "enabled" => $faker->boolean,
        "name" => $username,
        "slug" => Str::slug($username),
        "description" => $faker->sentence,
        "order" => $faker->numberBetween(0, Product::query()->count()),
        "created_at" => Carbon::now(),
        "updated_at" => Carbon::now()
    ];
});
