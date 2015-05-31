<?php

class CreateSponsors {
    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsors', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('image');
            $table->string('url');

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
        Schema::drop('sponsors');
    }

}