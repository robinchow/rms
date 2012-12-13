<?php

class Create_Seeds {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('users')->insert(array(
		    'email'  => 'example@example.com',
		    'password'  => Hash::make('example'),
		    'admin' => true
		));

		DB::table('profiles')->insert(array(
			'user_id' => 1,
		    'full_name'  => 'Example',
		    'display_name' => 'ex',
		    'image' => 'image.png'
		));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}