<?php

class CreateFaqs {
	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faqs', function($table) {
		    $table->increments('id');
		    $table->string('question');
		    $table->text('answer');
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
		Schema::drop('faqs');
	}

}