<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEmailMarketingQueue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_marketing_queue', function($table) {
            $table->bigIncrements('id');
            $table->integer('template_id')->default(0)->nullable();
            $table->integer('campain_id')->default(0)->nullable();
            $table->integer('merchant_id')->default(0)->nullable();
            $table->string('email')->nullable();
            $table->timestamp('send_schedule_at')->nullable();
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
        Schema::drop('email_marketing_queue');
    }
}
