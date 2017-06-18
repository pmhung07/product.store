<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsMarketingCampain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_marketing_campain', function($table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->text('sms')->nullable();
            $table->integer('merchant_id')->default(0)->nullable();
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
        Schema::drop('sms_marketing_campain');
    }
}
