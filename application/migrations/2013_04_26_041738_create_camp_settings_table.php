<?php

class Create_Camp_Settings_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('camp_settings', function($table) {
		    $table->increments('id');
		    $table->integer('year_id');
		    $table->integer('places');
		    $table->string('theme');
		    $table->text('details');
		    $table->boolean('visible');
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
		Schema::drop('camp_settings');
	}
}