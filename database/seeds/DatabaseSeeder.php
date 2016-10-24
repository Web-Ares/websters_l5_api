<?php

use Illuminate\Database\Seeder;
use App\User;
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
        $user->name = "Alex";
        $user->password = bcrypt("1111");
        $user->email = "alexksnikol@gmail.com";
        $user->save();

        $user = new User();
        $user->name = "User 2";
        $user->password = bcrypt("1111");
        $user->email = "alexksnikol123999@gmail.com";
        $user->save();


        $user = new User();
        $user->name = "User 1";
        $user->password = bcrypt("1111");
        $user->email = "alexksnikol99123239@gmail.com";
        $user->save();
    }
}