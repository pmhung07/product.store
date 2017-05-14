<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariantValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variant_values', function($table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->default(0)->nullable()->index();
            $table->bigInteger('variant_id')->default(0)->nullable();
            $table->string('values_str')->nullable();
            $table->string('values_int')->nullable()->index();
            $table->tinyInteger('status')->default(1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('variant_values');
    }
}
