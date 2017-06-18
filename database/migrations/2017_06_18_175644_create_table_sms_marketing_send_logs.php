<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSmsMarketingSendLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_marketing_send_log', function($table) {
            $table->bigIncrements('id');
            $table->integer('campain_id')->default(0)->nullable();
            $table->integer('customer_id')->default(0)->nullable();
            $table->string('customer_phone')->default(0)->nullable();
            $table->string('customer_name')->default(0)->nullable();
            $table->integer('status')->default(0)->nullable();
            $table->integer('merchant_id')->default(0)->nullable();
            $table->text('sms')->nullable();
            $table->text('error_log')->nullable();
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
        Schema::drop('sms_marketing_send_log');
    }
}
