<?php

class Create_Wellbeing_Night_Order {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wellbeing_night_order', function($table){
			$table->increments('id');
		    $table->integer('wellbeing_night_id');
		    $table->integer('wellbeing_order_id');
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
		Schema::drop('wellbeing_night_order');
	}

}