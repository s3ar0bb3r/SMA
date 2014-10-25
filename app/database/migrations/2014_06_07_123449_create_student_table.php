<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration {

    public function up()
    {
        Schema::create("students", function(Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments("id");
            $table->string("name", 250);
            $table->string("student_id", 250)->unique();
            $table->string("father_name");
            $table->string("mother_name");
            $table->string("guardian_name");
            $table->dateTime("date_of_birth");
            $table->string("gender");
            $table->string("nationality");
            $table->string("religion");
            $table->string("address");
            $table->string("contact_number");
            $table->string("email")->nullable();
            $table->string("student_img")->nullable();
            $table->string("father_img")->nullable();
            $table->string("mother_img")->nullable();
            $table->string("guardian_img")->nullable();
        });
    }

    public function down() {
        Schema::drop("students");
    }

}
