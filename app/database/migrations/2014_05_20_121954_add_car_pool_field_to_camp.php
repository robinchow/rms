<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCarPoolFieldToCamp extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('camp_registrations', function(Blueprint $table)
		{
			$table->string('car_pool');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('camp_registrations', function(Blueprint $table)
		{
			$table->dropColumn('car_pool');
		});
	}

}