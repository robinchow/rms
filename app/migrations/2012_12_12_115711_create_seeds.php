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
		    'email'  => 'c@c.com',
		    'password'  => Hash::make('c'),
		    'admin' => true
		));

		DB::table('profiles')->insert(array(
			'user_id' => 1,
		    'full_name'  => 'Chris M',
		    'display_name' => 'Chris',
		    'image' => 'image.png'
		));

		DB::table('users')->insert(array(
		    'email'  => 's@s.com',
		    'password'  => Hash::make('s'),
		    'admin' => false
		));

		DB::table('profiles')->insert(array(
			'user_id' => 2,
		    'full_name'  => 'Steve B',
		    'display_name' => 'Steve',
		    'image' => 'images.png'
		));

		DB::table('users')->insert(array(
		    'email'  => 'm@m.com',
		    'password'  => Hash::make('m'),
		    'admin' => true
		));

		DB::table('profiles')->insert(array(
			'user_id' => 3,
		    'full_name'  => 'Maddie J',
		    'display_name' => 'Maddie',
		    'image' => 'imagem.png'
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