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
        if (Schema::hasColumn('entity_products','atv')){
            Schema::table('entity_products', function (Blueprint $table) {
                $table->dropColumn('atv');
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

        Schema::table('entity_products', function (Blueprint $table) {
            $table->string('atv');
        });
    }
};
