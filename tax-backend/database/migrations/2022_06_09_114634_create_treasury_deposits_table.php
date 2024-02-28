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
        Schema::create('treasury_deposits', function (Blueprint $table) {
            $table->id();
            $table->string('treasury_challan_number');
            $table->string('bank');
            $table->string('branch');
            $table->string('district');
            $table->date('date');
            $table->string('deposit_account_code');
            $table->double('deposit_amount');
            $table->enum('deposit_type',['SD','VAT','excise duty','development surcharge','ICT development surcharge','health care surcharge','environmental protection surcharge']);
            $table->foreignId('entity_id')->constrained('entities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('transaction_id')->constrained('transactions')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('treasury_deposits');
    }
};
