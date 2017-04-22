<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableShopPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_pages', function($table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('teaser')->nullable();
            $table->string('content')->nullable();
            $table->integer('merchant_id')->default(0)->nullable();
            $table->integer('creator_id')->default(0)->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
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
        Schema::drop('shop_pages');
    }
}
