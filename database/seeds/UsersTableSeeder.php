<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $admin =  User::create([
            'name'     => 'admin_user',
            'email'    => 'admin@gmail.com',
            'password' =>Hash::make('admin')
        ]);
        $author = User::create([
            'name'     => 'author_user',
            'email'    => 'author@gmail.com',
            'password' =>Hash::make('author')
        ]);
        $user =  User::create([
            'name'     => 'user_user',
            'email'    => 'user@gmail.com',
            'password' =>Hash::make('user')
        ]);


        //first instance (first row i.e object)
        $admin_role  = Role::where('role_name','=','admin')->first();
        $author_role = Role::where('role_name','=','author')->first();
        $user_role   = Role::where('role_name','=','user')->first();

        //We have defined roles() function in User model
        //linking user object (row of user table) whith role object (row of role table)
        $admin->roles()->attach($admin_role);
        $author->roles()->attach($author_role);
        $user->roles()->attach($user_role);

    }
}
