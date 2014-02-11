<?php

class CreateYears {
	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('years', function($table) {
		    $table->increments('id');
		    $table->integer('year');
		    $table->string('name');
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
		Schema::drop('years');

	}

}