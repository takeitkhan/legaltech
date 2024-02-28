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
      
        Schema::table('entity_products', function (Blueprint $table) {
            $table->enum('is_tracking',[0,1])->default(0);
            $table->double('unit_price')->default(0);
            $table->double('qty')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entity_products', function (Blueprint $table) {
            $table->dropColumn('is_tracking');
            $table->dropColumn('unit_price');
            $table->dropColumn('qty');
        });
    }
};
