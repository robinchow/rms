<?php

class CreateMerchItemOrder {
    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merch_item_order', function($table){
            $table->increments('id');
            $table->integer('merch_item_id');
            $table->integer('merch_order_id');
            $table->integer('quantity');
            $table->string('size');
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
        Schema::drop('merch_item_order');
    }

}