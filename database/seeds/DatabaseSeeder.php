<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User',100)->create();
        factory('App\Quiz',100)->create();
        factory('App\Question',100)->create();
        factory('App\Course',100)->create();
        factory('App\Video',100)->create();
        factory('App\Track',100)->create();
        factory('App\Photo',100)->create();
    }
}
