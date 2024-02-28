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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('hs_code')->unqiue();
            $table->string('title')->nullable();
            $table->text('details')->nullable();
            $table->string('unit');
            $table->double('cd');
            $table->double('sd_rate')->default(0);
            $table->double('vat_rate')->default(0);
            $table->double('ait');
            $table->double('rd');
            $table->string('atv');
            $table->double('at');
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
        Schema::dropIfExists('products');
    }
};
