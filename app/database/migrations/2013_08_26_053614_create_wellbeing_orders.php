<?php

class CreateWellbeingOrders {
	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wellbeing_orders', function($table){
			$table->increments('id');
		    $table->integer('user_id');
		    $table->integer('year_id');
		    $table->text('dietary_requirements')->nullable();
		    $table->boolean('paid');
		    $table->boolean('all');
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
		Schema::drop('wellbeing_orders');
	}

}