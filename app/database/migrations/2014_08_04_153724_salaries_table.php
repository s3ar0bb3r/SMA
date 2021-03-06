<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SalariesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
	    Schema::create("salaries", function(Blueprint $table){
            $table->increments("id");
            $table->integer("month");
            $table->integer("year");
            $table->double("amount");
            $table->float("extra_payment")->default(0);
            $table->float("deduction")->default(0);
            $table->string("comment")->nullable();
            $table->integer("user_id")->unsigned();
            $table->integer("beneficiary_id")->unsigned();
            $table->timestamps();
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("beneficiary_id")->references("id")->on("beneficiaries");

        });
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
        Schema::drop("salaries");
    }

}
