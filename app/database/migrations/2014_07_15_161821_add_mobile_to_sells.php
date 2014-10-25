<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMobileToSells extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sells', function(Blueprint $table)
		{

		});
	}

	public function down()
	{
        Schema::table("sells", function(Blueprint $table){
            $table->dropColumn("mobile");
        });
	}

}
