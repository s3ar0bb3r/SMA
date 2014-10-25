<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration {

    public function up()
    {
        Schema::create("students", function(Blueprint $table){
            $table->engine = "InnoDB";
            $table->increments("id");
            $table->string("name", 250);
            $table->string("student_id", 250);
            $table->string("father_name")->nullable();
            $table->string("mother_name")->nullable();
            $table->string("guardian_name")->nullable();
            $table->dateTime("date_of_birth")->nullable();
            $table->string("gender")->nullable();
            $table->string("nationality")->nullable();
            $table->string("religion")->nullable();
            $table->string("address")->nullable();
            $table->string("contact_number")->nullable();
            $table->string("email")->nullable();
            $table->string("student_img")->nullable();
            $table->string("father_img")->nullable();
            $table->string("mother_img")->nullable();
            $table->string("guardian_img")->nullable();
        });
    }

    public function down()
    {
        Schema::drop("student");
    }

}
