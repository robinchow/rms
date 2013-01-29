<?php

class Seed_Exec_Positions {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('executives')->insert(array(
		    'position'  => 'Directors',
		    'alias'  => 'directors',
		));
		DB::table('executives')->insert(array(
		    'position'  => 'Producers',
		    'alias'  => 'producers',
		));
		DB::table('executives')->insert(array(
		    'position'  => 'Treasurer',
		    'alias'  => 'treasurer',
		));
		DB::table('executives')->insert(array(
		    'position'  => 'Secretary',
		    'alias'  => 'secretary',
		));
		DB::table('executives')->insert(array(
		    'position'  => 'ARC Delegate',
		    'alias'  => 'arc',
		));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('executives')->delete();
	}

}
