<?php

class Create_Camp_Registration_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('camp_registration', function($table) {
		    $table->increments('id');

		    $table->integer('camp_settings_id');
		    $table->integer('user_id'); //lets us get name, contact details, dob

			$table->boolean('medical');
		    $table->text('medical_conditions')->nullable();

		    $table->boolean('dietary');
		    $table->text('dietary_requirements')->nullable();

		    $table->boolean('car');
		    $table->integer('car_places')->nullable();

		    $table->text('song_requests')->nullable();

		    $table->boolean('paid');
		    $table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('camp_registration');
	}
}