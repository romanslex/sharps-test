<?php

use Faker\Generator as Faker;
use Models\Transaction;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'amount' => $faker->numberBetween(100, 2500),
        'balance' => $faker->numberBetween(1000, 10000),
        'performed_at' => $faker->dateTimeBetween("-1 month", "now")
    ];
});
