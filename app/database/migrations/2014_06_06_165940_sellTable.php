<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SellTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sells', function(Blueprint $table) {
            $table->increments("id");
            $table->integer("user_id")->unsigned();
            $table->string("mobile",25)->nullable();
            $table->string("student_id")->nullable();
            $table->string("clazz")->nullable();
            $table->string("section")->nullable();
            $table->timestamps();
            $table->foreign("user_id")->references("id")->on("users");
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop("sells");
	}

}
