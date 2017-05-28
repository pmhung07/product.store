<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigations', function($table) {
            $table->increments('id');
            $table->string('label')->nullable();
            $table->string('url')->nullable();
            $table->tinyInteger('type')->default(0)->nullable();
            $table->integer('object_id')->default(0)->nullable();
            $table->integer('parent_id')->default(0)->nullable();
            $table->integer('merchant_id')->default(0)->nullable();
            $table->integer('creator_id')->default(0)->nullable();
            $table->tinyInteger('has_child')->default(0)->nullable();
            $table->tinyInteger('level')->default(0)->nullable();
            $table->bigInteger('sort')->default(0)->nullable();
            $table->tinyInteger('active')->default(1)->nullable();
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
        Schema::drop('navigations');
    }
}
