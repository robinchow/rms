<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionAndLevelToSponsors extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sponsors', function(Blueprint $table)
        {
            $table->string('description');
        });

        Schema::table('sponsor_year', function(Blueprint $table)
        {
            $table->string('sponsor_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsors', function(Blueprint $table)
        {
            $table->dropColumn('description');
        });

        Schema::table('sponsor_year', function(Blueprint $table)
        {
            $table->dropColumn('sponsor_level');
        });
    }


}
