<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransportFeeTable extends Migration {
    public function up(){
        Schema::create("transport_fees", function(Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments("id");
            $table->integer("number_of_month");
            $table->double("amount");
            $table->double("discount")->defalts(0);
            $table->double("fine")->defalts(0);
            $table->string("comment")->nullable();
            $table->integer("student_id")->unsigned();
            $table->timestamps();
            $table->foreign("student_id")->references("id")->on("students");
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users");
            $table->integer("transport_fee_count_id")->unsigned();
            $table->foreign("transport_fee_count_id")->references("id")->on("transport_fee_counts");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop("transport_fees");
    }
}
