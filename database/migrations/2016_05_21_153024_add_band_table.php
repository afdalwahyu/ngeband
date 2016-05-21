<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('band', function (Blueprint $table) {
            $table->increments('id');
            //creator maker
            $table->integer('user_id')->unsigned();
            //list joined band
            $table->integer('bandmember_id')->unsigned();
            //list requested user
            $table->integer('reqjoin_id')->unsigned();
            $table->time('time');
            $table->string('place');
            $table->mediumText('description');
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
        Schema::drop('band');
    }
}
