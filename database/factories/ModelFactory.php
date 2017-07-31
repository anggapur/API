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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'company_name' => 'Company '.$faker->name,
        'username' => $faker->userName,
        'identity_id' => $faker->unique()->randomNumber(6),
        'identity_category' => 'KTP',
        'phone' => $faker->phoneNumber,
        'avatar' => 'avatar'.$faker->randomNumber(1).'.jpg',
        'send_from' => $faker->city,
    ];
});

$factory->define(App\product::class, function (Faker\Generator $faker) {    
	
    return [
        'name' => $faker->word,
        'price' => $faker->randomNumber(6),
        'price_sell' => $faker->randomNumber(6)+5000,
        'desc' => $faker->paragraph,        
        'stock' => $faker->randomNumber(2),
        'featured_image' => "image".$faker->randomNumber(1).".jpg",
        'seller_id' => $faker->randomNumber(1),
        'category_id' => $faker->randomNumber(1),
        'weight' => $faker->randomNumber(2),
    ];
});

$factory->define(App\category::class,function(Faker\Generator $faker){
	return [
		'name' => 'category '.$faker->name,
		'parent_id' => $faker->randomNumber(1),		
	];
});

$factory->define(App\rate::class,function(Faker\Generator $faker){
	return [
		'comment_by' => $faker->randomNumber(1),
		'comment' => $faker->paragraph,
		'star' => $faker->randomNumber(1),		
	];
});

$factory->define(App\seen::class,function(Faker\Generator $faker){
	return [
		'ip' => $faker->randomNumber(5),		
	];
});

$factory->define(App\favorite::class,function(Faker\Generator $faker){
	return [
		'product_id' => $faker->randomNumber(1),		
		'user_id' => $faker->randomNumber(1),		
	];
});

$factory->define(App\image::class,function(Faker\Generator $faker){
	return [
		'product_id' => $faker->randomNumber(1),		
		'image' => "image".$faker->randomNumber(1).".jpg",	
	];
});