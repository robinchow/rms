<?php

class CreateNews {
    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function($table) {
            $table->increments('id');
               $table->string('title');
            $table->text('post');
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
        Schema::drop('news');
    }

}