<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create("registrations", function(Blueprint $table){
            $table->engine = "InnoDB";
            $table->increments("id");
            $table->string("student_unique_id");
            $table->timestamps();
            $table->boolean("has_transport");
            $table->float("transport_fee")->nullable();
            $table->string("clazz");
            $table->integer("year");
            $table->string("section")->nullable();
            $table->string("shift")->nullable();
            $table->boolean("has_relative");
            $table->string("relative_id")->nullable();
            $table->string("relative_class")->nullable();
            $table->string("relative_section")->nullable();
            $table->boolean("is_readmission");
            $table->float("fee");
            $table->string("area")->nullable();
            $table->float("tuition_fee");
            $table->integer("student_id")->unsigned();
            $table->foreign("student_id")->references("id")->on("students");
            $table->foreign("student_unique_id")->references("student_id")->on("students");
            $table->unique(array("year", "student_id"));
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop("registrations");
	}

}
