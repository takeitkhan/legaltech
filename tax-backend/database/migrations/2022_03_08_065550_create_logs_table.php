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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId("document_id")->constrained('documents')->onDelete("cascade")->onUpdate('cascade');
            $table->foreignId("transaction_id")->constrained('transactions')->onUpdate('cascade');
            $table->dateTime('log_date_time');
            $table->enum('old_status',['uploaded','submitted','drafted','approved','rejected','filed']);
            $table->enum('new_status',['uploaded','submitted','drafted','approved','rejected','filed']);
            $table->text('body');
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
        Schema::dropIfExists('logs');
    }
};
