<?php

class Create_Blog_Posts_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blog_posts', function($table){
			$table->increments('id');
			$table->string('title',128);
			$table->text('body');
			$table->integer('author id');
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
		Schema::drop('blog_posts');
	}

}