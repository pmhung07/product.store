<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEmailMarketingSendMailLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_marketing_send_mail_logs', function($table) {
            $table->bigIncrements('id');
            $table->integer('campain_id')->default(0)->nullable();
            $table->integer('template_id')->default(0)->nullable();
            $table->integer('customer_id')->default(0)->nullable();
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
        Schema::drop('email_marketing_send_mail_logs');
    }
}
