<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    //This function will be fired when you run seed artisan command
    public function run()
    {
        // $this->call(UserSeeder::class);
        /*DB::table('posts')->insert([
            'title' => Str::random(30),
            'body'  => Str::random(500),
            'slug'  => Str::random(20)
        ]);*/
        
        
        
        DB::table('comments')->insert([
            'comment'=>Str::random(40),
            'user_id'=>1,
            'post_id'=>1
        ]);
        //$this->call(RolesTableSeeder::class);
        //$this->call(UsersTableSeeder::class);
    }
}
