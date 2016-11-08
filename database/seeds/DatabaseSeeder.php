<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);

         $this->call(RoleTableSeeder::class);
    }
}

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->email = "alexksnikol@gmail.com";
        $user->remember_token = str_random(100);
        $user->save();
        
        $user = new User();
        $user->email = "petruninnikolay@gmail.com";
        $user->remember_token = str_random(100);
        $user->save();

        $user = new User();
        $user->email = "london.tokyo.madrid@gmail.com";
        $user->remember_token = str_random(100);
        $user->save();

        $user = new User();
        $user->email = "snike1985@gmail.com";
        $user->remember_token = str_random(100);
        $user->save();

    }
    
    
}

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'Admin';
        $role->save();

        $role = new Role();
        $role->name = 'User';
        $role->save();
    }

}