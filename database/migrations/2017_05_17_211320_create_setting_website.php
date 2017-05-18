<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingWebsite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_website', function($table) {
            $table->increments('id');
            $table->integer('merchant_id')->default(0)->nullable();
            $table->string('logo')->nullable();
            $table->string('company_name')->nullable();
            $table->integer('province_id')->default(0)->nullable();
            $table->integer('district_id')->default(0)->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('mail')->nullable();
            $table->string('skype')->nullable();
            $table->string('yahoo')->nullable();
            $table->string('facebook')->nullable();
            $table->string('google')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('tumblr')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
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
        Schema::drop('setting_website');
    }
}
