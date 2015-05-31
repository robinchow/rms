<?php

class CreateTeamYear {
    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_year', function($table) {
            $table->increments('id');
            $table->integer('team_id');
            $table->integer('year_id');
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
        Schema::drop('team_year');
    }

}
