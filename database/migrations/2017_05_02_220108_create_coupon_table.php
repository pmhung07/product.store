<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon', function($table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->double('value')->nullable();
            $table->text('data')->nullable(); // Json id sp hoặc id danh mục
            $table->tinyInteger('type_value')->default(0)->nullable();
            $table->tinyInteger('type')->default(0)->nullable();
            $table->integer('creator_id')->default(0)->nullable();
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
        Schema::drop('coupon');
    }
}
