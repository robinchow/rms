<?php

class CreateUsers {

    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function($table) {
            $table->increments('id');
            $table->string('email', 128)->unique();
            $table->string('password');
            $table->string('reset_password_hash')->nullable();
            $table->boolean('admin');
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
        Schema::drop('users');
    }

}
