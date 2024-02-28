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
        Schema::create('transaction_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('entity_product_id')->nullable();
            $table->string('product_name');
            $table->string('unit');
            $table->double('unit_price');
            $table->integer('qty')->default(1);
            $table->double('sd_rate');
            $table->double('at_rate')->nullable();
            $table->double('tax_rate')->nullable();
            $table->double('ait')->nullable();
            $table->double('rd')->nullable();
            $table->double('cd')->nullable();
            $table->double('taxable_value')->nullable();
            $table->double('sd_rate_value')->nullable();
            $table->double('tax_rate_value')->nullable();
            $table->double('at_rate_value')->nullable();
            $table->unsignedBigInteger('tax_rate_id')->nullable();
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
        Schema::dropIfExists('transaction_products');
    }
};
