<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWellbeingBundleOrderTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wellbeing_bundle_order', function($table) {
            $table->increments('id');
            $table->integer('wellbeing_bundle_id');
            $table->integer('wellbeing_order_id');
            $table->timestamps();
       });
     //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('wellbeing_bundle_order');
    }

}
