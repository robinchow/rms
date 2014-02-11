<?php

class Create_Teams {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teams', function($table) {
		    $table->increments('id');
		    $table->string('name');
		    $table->string('alias');
		    $table->boolean('privacy');
		    $table->text('description')->nullable();
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
		Schema::drop('teams');

	}

}
