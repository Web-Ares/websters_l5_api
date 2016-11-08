<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned()->default(2);
            $table->string('name')->default('');
            $table->string('email')->unique();
            $table->string('avatar')->default('');
            $table->string('google_token')->default('');
            $table->string('refresh_google_token')->default('');
            $table->string('remember_token',100)->unique()->default('');;
            $table->string('expires')->default('');;
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }

}
