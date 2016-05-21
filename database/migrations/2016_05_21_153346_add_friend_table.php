<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFriendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friend', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id_action')->unsigned();
            $table->integer('user_id_response')->unsigned();
            //0 -> pending 1->accepted 2-> declined
            $table->enum('status', [0,1,2]);
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
        Schema::drop('friend');
    }
}
