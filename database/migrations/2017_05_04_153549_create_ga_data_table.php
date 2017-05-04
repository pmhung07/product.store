<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGaDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ga_data', function($table) {
            $table->increments('id');
            $table->double('bounce_rate')->default(0)->nullable();
            $table->double('page_view')->default(0)->nullable();
            $table->double('unique_page_view')->default(0)->nullable();
            $table->double('visit')->default(0)->nullable();
            $table->double('session_duration')->default(0)->nullable();
            $table->double('avg_session_duration')->default(0)->nullable();
            $table->double('time_on_page')->default(0)->nullable();
            $table->double('avg_time_on_page')->default(0)->nullable();
            $table->date('date')->nullable();
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
        Schema::drop('ga_data');
    }
}
