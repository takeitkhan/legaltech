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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_id')->constrained('entities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('transaction_type_id')->constrained('transaction_types')->onUpdate('cascade')->onDelete('cascade');
            $table->string('invoice_no')->nullable();//unique for individual company
            $table->datetime('transaction_date');
            $table->enum('transaction_category',['local','international'])->default('local');
            $table->unsignedBigInteger('document_type_id');
            $table->string('document_type');
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate();
            $table->foreignId('contact_id')->constrained('contacts')->cascadeOnUpdate();
            $table->string('contact_name');
            $table->string('contact_code')->nullable();//unqiue according to  entity
            $table->foreignId('employee_id')->constrained('employees')->onUpdate('cascade');
            $table->double('total_taxable_value')->default(0);
            $table->double('total_tax_value')->default(0);
            $table->double('total_sd_value')->default(0);
            $table->double('total_at_value')->default(0);
            $table->double('total_ait')->default(0);
            $table->double('total_rd')->default(0);
            $table->double('total_cd')->default(0);
            $table->integer('quantity')->nullable();//document quantity
            $table->enum('review_status',['submitted','drafted','approved','rejected','filed']);
            $table->dateTime('submitted_at')->nullable();
            $table->dateTime('drafted_at')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('rejected_at')->nullable();
            $table->dateTime('filed_at')->nullable();
            $table->string('office_code')->nullable();
            $table->string('item_no')->nullable();
            $table->string('CPC')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
