<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Position;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RoleTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(PositionSeeder::class);

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

        $role_user = Role::find(2);
        
//        $user = new User();
//        $user->email = "alexksnikol@gmail.com";
//        $user->remember_token = str_random(100);
//        $role_user->users()->save($user);
//
//
        $user = new User();
        $user->email = "petruninnikolay@gmail.com";
        $user->remember_token = str_random(100);
        $role_user->users()->save($user);
//
//        $user = new User();
//        $user->email = "london.tokyo.madrid@gmail.com";
//        $user->remember_token = str_random(100);
//        $role_user->users()->save($user);
//
//        $user = new User();
//        $user->email = "snike1985@gmail.com";
//        $user->remember_token = str_random(100);
//        $role_user->users()->save($user);

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

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
    }
}
