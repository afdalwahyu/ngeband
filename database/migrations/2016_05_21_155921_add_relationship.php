<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('band', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('friend', function ($table) {
            $table->foreign('user_id_action')->references('id')->on('users');
            $table->foreign('user_id_response')->references('id')->on('users');
        });
        Schema::table('reqjoin', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('band_id')->references('id')->on('band');
        });
        Schema::table('bandmember', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('band_id')->references('id')->on('band');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
