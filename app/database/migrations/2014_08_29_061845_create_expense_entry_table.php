<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseEntryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
        Schema::create("expenses", function(Blueprint $table) {
            $table->increments("id");
            $table->double("amount");
            $table->string("comment")->nullable();
            $table->integer("expense_type_id")->unsigned();
            $table->integer("user_id")->unsigned();
            $table->foreign("expense_type_id")->references("id")->on("expense_types");
            $table->foreign("user_id")->references("id")->on("users");
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
        Schema::drop("expense_entries");
	}

}
