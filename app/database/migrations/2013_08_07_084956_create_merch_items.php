<?php

class CreateMerchItems {
	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('merch_items', function($table){
			$table->increments('id');
			$table->string('title',128);
			$table->text('description');
			$table->float('price');
			$table->boolean('has_size');
			$table->boolean('active');
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
		Schema::drop('merch_items');
	}

}