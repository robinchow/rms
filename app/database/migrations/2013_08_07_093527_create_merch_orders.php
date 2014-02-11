<?php

class CreateMerchOrders {
	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('merch_orders', function($table){
			$table->increments('id');
		    $table->integer('user_id');
		    $table->integer('year_id');
		    $table->float('amount_paid');
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
		Schema::drop('merch_orders');
	}

}