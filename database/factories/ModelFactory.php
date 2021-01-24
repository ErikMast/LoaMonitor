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
$factory->define(LoaMonitor\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(LoaMonitor\Group::class, function(Faker\Generator $faker) {
  return [
    'id' => $faker->randomDigit(),
    'name'=>$faker->company(),
    'is_visible' => true
  ];
});

$factory->define(LoaMonitor\Progress::class, function(Faker\Generator $faker) {
  return [
      'date' =>new DateTime(),
      'date_deadline' =>null,
      'students_id' =>$faker->randomDigit(),
      'deadline_met' => false,
      'notes' => 'Progress text',
      'users_id' => $faker->randomDigit()
  ];
});

$factory->define(LoaMonitor\Student::class, function(Faker\Generator $faker) {
  return [
      'id' =>$faker->randomDigit(),
      'firstname'=>$faker->firstName(),
      'lastname'=>$faker->lastName(),
      'student_number'=>"111111",
      'villages_id' =>1,
      'end_date'=>null,
      'eta' => null,
      'groups_id' => null
  ];
});
