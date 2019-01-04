<?php

use Faker\Generator as Faker;
use Larafa\UserProfile\Profile;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'user_id'=> $faker->unique()->randomDigit,
		'about_me'=> $faker->sentence() ,
		'gender'=> $faker->randomElement($array = array ('m','f')) ,
		'birthday'=> $faker->date ,
		'country'=> $faker->country ,
		'city'=> $faker->city ,
		'created_at'=>$faker->dateTime,
    ];
});
