<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteTableVariantCombination extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('variant_combination');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('variant_combination', function($table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id');
            $table->bigInteger('value_1');
            $table->bigInteger('value_2');
            $table->bigInteger('value_3');
        });
    }
}
