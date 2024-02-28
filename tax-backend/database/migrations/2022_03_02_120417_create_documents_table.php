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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file_extension');
            $table->foreignId('user_id')->constrained('users')->onUpdate("cascade");
            $table->foreignId('transaction_id')->constrained('transactions')->onUpdate("cascade")->onDelete('cascade');
            $table->foreignId('entity_id')->constrained('entities')->onUpdate("cascade")->onDelete('cascade');
            $table->foreignId('document_type_id')->constrained('document_types')->onUpdate("cascade");
            $table->enum('status',['draft','failed','filed','review','approved','trashed'])->default('draft');
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
        Schema::dropIfExists('documents');
    }
};
