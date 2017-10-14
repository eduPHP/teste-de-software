<?php

use Faker\Generator as Faker;

$factory->define(App\Associado::class, function (Faker $faker) {
    return [
        'desligado'=> false,
        'bloqueado'=> false,
    ];
});
