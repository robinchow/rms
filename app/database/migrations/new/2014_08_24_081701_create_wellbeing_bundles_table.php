<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWellbeingBundlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('wellbeing_bundles', function($table) {
		    $table->increments('id');
            $table->string('name');
            $table->integer('year_id');
		    $table->timestamps();
       });
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('wellbeing_bundles');
	}

}
