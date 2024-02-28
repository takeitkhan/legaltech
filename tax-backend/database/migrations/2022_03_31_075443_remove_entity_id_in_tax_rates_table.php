<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('tax_rates','entity_id')){
            Schema::table('tax_rates', function (Blueprint $table) {
                $table->dropForeign('tax_rates_entity_id_foreign');
                $table->dropColumn('entity_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('at_rates', function (Blueprint $table) {
            //
        });
    }
};