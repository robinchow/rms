<?php

class Create_Sponsor_Year {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sponsor_year', function($table) {
		    $table->increments('id');
		    $table->integer('sponsor_id');
		    $table->integer('year_id');
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
		Schema::drop('sponsor_year');
	}

}