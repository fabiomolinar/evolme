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

$factory->define(Evolme\Roles::class,function (){
   return [
        'role_name' => 'User',
        'role_description' => 'Usuário comum do site'
   ];
});

$factory->define(Evolme\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'last_name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'role_id' => 1,
        'remember_token' => str_random(10),
    ];
});

$factory->define(Evolme\Organization::class, function ($faker) {
    return [
        'name' => $faker->company,
        'phone' => $faker->phoneNumber,
        'is_verified' => true
    ];
});

$factory->define(Evolme\Photo::class,function ($faker){
    $type = $faker->randomElement(array('Evolme\Organization','Evolme\User'));
    $id = 0;
    if ($type == 'Evolme\Organization'){
        $id = $faker->randomElement(Evolme\Organization::lists('id')->toArray());
    }else{
        $id = $faker->randomElement(Evolme\User::lists('id')->toArray());
    }
    return [
        'path' => $faker->image,
        'is_profile' => false,
        'imageable_id' => $id,
        'imageable_type' => $type,
    ];
});

$factory->define(Evolme\OrganizationUser::class,function ($faker){
    $organization_id =  $faker->randomElement(Evolme\Organization::lists('id')->toArray());
    $user_id = $faker->randomElement(Evolme\User::lists('id')->toArray());

    return [
        'organization_id' => $organization_id,
        'user_id' => $user_id
   ];
});



