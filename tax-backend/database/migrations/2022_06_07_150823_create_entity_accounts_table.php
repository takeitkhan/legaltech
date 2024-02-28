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
        Schema::create('entity_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_id')->constrained('entities')->onUpdate('cascade')->onDelete('cascade');
            $table->double('closing_balance_vat')->default(0);
            $table->double('closing_balance_sd')->default(0);
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
        Schema::dropIfExists('entity_accounts');
    }
};
