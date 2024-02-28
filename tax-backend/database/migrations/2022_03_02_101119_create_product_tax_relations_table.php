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
        Schema::create('product_tax_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_product_id')->constrained('entity_products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('tax_rate_id')->constrained('tax_rates')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('product_tax_relations');
    }
};
