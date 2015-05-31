<?php

class CreateExecutiveUser {
    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('executive_user', function($table) {
            $table->increments('id');
            $table->string('executive_id');
            $table->string('user_id');
            $table->string('year_id');
            $table->boolean('non_executive');
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
        Schema::drop('executive_user');

    }

}