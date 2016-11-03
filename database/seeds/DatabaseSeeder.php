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
        $user->email = "alexksnikol@gmail.com";
        $user->remember_token = str_random(100);
        $user->save();

        $user = new User();
        $user->email = "tanyanya13@gmail.com";
        $user->remember_token = str_random(100);
        $user->save();

    }
}