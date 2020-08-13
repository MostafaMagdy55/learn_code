<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Question;
use App\Quiz;
use App\Track;
use App\User;
use App\Video;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'score'=>$faker->randomElement([10,20,30,40,50,60,70,80,90,100])
    ];


});


$factory->define(Photo::class, function (Faker $faker) {
    $userid=User::all()->random()->id;
    $courseid=Course::all()->random()->id;
    $photoable_id=$faker->randomElement($userid,$courseid);
    $photoable_type=$userid==$photoable_id?'App\User':'App\Photo';

    return [
        'filename'=>$faker->randomElement(['1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg','10.jpg']),
        'photoable_id'=>$photoable_id,
        'photoable_type'=>$photoable_type,

    ];
});

$factory->define(Track::class, function (Faker $faker) {

    return [
        'name'=>$faker->word,

    ];
});


$factory->define(Course::class, function (Faker $faker) {

    return [
        'title'=>$faker->paragraph,
        'status'=>$faker->randomElement([0,1]),
        'link'=>$faker->url,
       // 'track_id'=>Track::all()->random()->id,
    ];
});


$factory->define(Quiz::class, function (Faker $faker) {

    return [
        'name'=>$faker->word,
       // 'course_id'=>Course::all()->random()->id,
    ];
});

$factory->define(Video::class, function (Faker $faker) {

    return [
        'title'=>$faker->paragraph,
        'link'=>$faker->url,
        'course_id'=>Course::all()->random()->id,
    ];
});



$factory->define(Question::class, function (Faker $faker) {
    $answer=$faker->paragraph;
    $right_answer=$faker->randomElement(explode(' ', $answer));
    return [
       'title'=>$faker->paragraph,
       'answers'=>$faker->paragraph,
       'score'=>$faker->randomElement([1,10,15,20]),
       'answers'=>$answer,
       'right_answers'=>$right_answer,
       'quiz_id'=>Quiz::all()->random()->id,

    ];
});






