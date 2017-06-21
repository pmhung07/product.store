<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableEmailMarketingQueueAddCustomerId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_marketing_queue', function($table) {
            $table->integer('customer_id')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_marketing_queue', function($table) {
            $table->dropColumn('customer_id');
        });
    }
}
