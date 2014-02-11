<?php

class CreateUserYear {
	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_year', function($table) {
		    $table->increments('id');
		    $table->integer('user_id');
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
		Schema::drop('user_year');

	}

}