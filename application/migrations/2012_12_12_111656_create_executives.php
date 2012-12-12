<?php

class Create_Executives {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('executives', function($table) {
		    $table->increments('id');
		    $table->string('position');
		    $table->string('alias');
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
		Schema::drop('executives');

	}

}