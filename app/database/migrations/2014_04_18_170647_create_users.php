<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('users', function(Blueprint $table){
            $table->increments('id');
            $table->string('username', 100)->unique();
            $table->string('password', 100);
            $table->string("email");
            $table->string("remember_token", 100)->nullable();
            $table->unique("email");
            $table->string("first_name", 100);
            $table->string("last_name", 100)->nullable();
            $table->integer("weight");
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
