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
        if (!Schema::hasColumn('product_tax_relations','nature_id')){
            Schema::table('product_tax_relations', function (Blueprint $table) {
                $table->foreignId('nature_id')->nullable()->constrained('product_natures')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('product_tax_relations', function (Blueprint $table) {
            //
        });
    }
};
