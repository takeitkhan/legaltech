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
        Schema::create('vat_adjustments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_id')->constrained('entities')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->double('amount');
            $table->double('vat_rate');
            $table->date('adjustment_date');
            $table->enum('adjustment_type',['increasing','decreasing']);
            $table->foreignId('transaction_id')->constrained('transactions')->cascadeOnUpdate();
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
        Schema::dropIfExists('v_a_t_adjustments');
    }
};
