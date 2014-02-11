<?php

class CreateTeamUser {
	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('team_user', function($table) {
		    $table->increments('id');
		    $table->integer('team_id');
		    $table->integer('user_id');
		    $table->integer('year_id');
		    $table->string('status');
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
		Schema::drop('team_user');
	}

}