<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeighnKeyTechnology extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('technologies', function (Blueprint $table) {
            $table->integer('position_id')->unsigned()->nullable();
        });

        Schema::table('technologies', function (Blueprint $table) {
            $table->foreign('position_id')->references('id')->on('positions');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      

        Schema::table('technologies', function (Blueprint $table) {

            $table->dropForeign('technologies_position_id_foreign');
            $table->dropColumn('position_id');
        });


    }
}
