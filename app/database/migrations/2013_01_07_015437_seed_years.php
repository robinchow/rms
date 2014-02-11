<?php

class SeedYears {
	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('years')->insert(array(
		    'year'  => 2002,
		    'name'  => 'Microsoft Minority Revue',
		    'alias' => '02'
		));
		DB::table('years')->insert(array(
		    'year'  => 2003,
		    'name'  => 'CSE Revue Reloaded',
		    'alias' => '03'
		));
		DB::table('years')->insert(array(
		    'year'  => 2004,
		    'name'  => 'Star Key & Hash',
		    'alias' => '04'
		));
		DB::table('years')->insert(array(
		    'year'  => 2005,
		    'name'  => 'Sin CSE',
		    'alias' => '05'
		));
		DB::table('years')->insert(array(
		    'year'  => 2006,
		    'name'  => 'The teXt Files: Close Encounters of the Nerd Kind',
		    'alias' => '06'
		));
		DB::table('years')->insert(array(
		    'year'  => 2007,
		    'name'  => 'Sand Theft Auto: Agrabah City',
		    'alias' => '07'
		));
		DB::table('years')->insert(array(
		    'year'  => 2008,
		    'name'  => 'CSE++ //Revue Goes Large',
		    'alias' => '08'
		));
		DB::table('years')->insert(array(
		    'year'  => 2009,
		    'name'  => 'Gossip Geek',
		    'alias' => '09'
		));
		DB::table('years')->insert(array(
		    'year'  => 2010,
		    'name'  => 'Pacman: The Dark Byte',
		    'alias' => '10'
		));
		DB::table('years')->insert(array(
		    'year'  => 2011,
		    'name'  => 'Hack To the Future',
		    'alias' => '11'
		));
		DB::table('years')->insert(array(
		    'year'  => 2012,
		    'name'  => 'Codebusters',
		    'alias' => '12'
		));
		DB::table('years')->insert(array(
		    'year'  => 2013,
		    'name'  => 'TBA',
		    'alias' => '13'
		));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('years')->delete();
	}

}