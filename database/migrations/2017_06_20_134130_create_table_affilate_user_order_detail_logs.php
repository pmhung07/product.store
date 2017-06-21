<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAffilateUserOrderDetailLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliate_user_order_detail_logs', function($table) {
            $table->bigIncrements('id');
            $table->integer('affiliate_user_product_id')->default(0)->nullable();
            $table->integer('order_id')->default(0)->nullable();
            $table->integer('order_detail_id')->default(0)->nullable();
            $table->integer('product_id')->default(0)->nullable();
            $table->integer('merchant_id')->default(0)->nullable();
            $table->integer('quantity')->default(0)->nullable();
            $table->integer('price')->default(0)->nullable();
            $table->double('profit')->default(0)->nullable();
            $table->integer('money')->default(0)->nullable();
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
        Schema::drop('affiliate_user_order_detail_logs');
    }
}
