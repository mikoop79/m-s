<?php
use App\Report;
use Faker\Generator as Faker;

$factory->define(Report::class, function (Faker $faker) {
    return [
    	'name' => $faker->name,
        'description' => $faker->sentence
    ];
});
