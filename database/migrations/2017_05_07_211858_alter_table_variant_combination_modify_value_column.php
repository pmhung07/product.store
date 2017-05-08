<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableVariantCombinationModifyValueColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('variant_combination', function($table) {
            $table->dropColumn('value_1');
            $table->dropColumn('value_2');
            $table->dropColumn('value_3');
            $table->bigInteger('value_id')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('variant_combination', function($table) {
            $table->dropColumn('value_id');
        });
    }
}
