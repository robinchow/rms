<?php

class CreateWellbeingNights {
    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wellbeing_nights', function($table){
            $table->increments('id');
            $table->integer('year_id');
            $table->date('date');
            $table->float('price');
            $table->float('special_price');
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
        Schema::drop('wellbeing_nights');
    }

}