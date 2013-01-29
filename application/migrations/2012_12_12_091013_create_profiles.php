<?php

class Create_Profiles {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function($table) {
		    $table->increments('id');
    		$table->string('full_name', 128);
    		$table->string('display_name', 128)->unique();
    		$table->string('gender',1);
    		$table->date('dob')->nullable();
    		$table->string('image');
    		$table->boolean('privacy');
    		$table->string('phone',12);
    		$table->string('university');
    		$table->string('program');
    		$table->string('student_number')->nullable();
    		$table->date('start_year')->nullable();
    		$table->boolean('arc');
    		$table->integer('user_id');
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
		Schema::drop('profiles');

	}

}
