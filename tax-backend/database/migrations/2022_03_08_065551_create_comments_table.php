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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("document_id")->constrained('documents')->onDelete("cascade")->onUpdate('cascade');
            $table->foreignId("transaction_id")->constrained('transactions')->onDelete("cascade")->onUpdate('cascade');
            $table->foreignId("to_user_id")->constrained('users')->onDelete("cascade")->onUpdate('cascade');
            $table->foreignId("from_user_id")->constrained('users')->onDelete("cascade")->onUpdate('cascade');
            $table->foreignId("log_id")->constrained('logs')->onDelete("cascade")->onUpdate('cascade');
            $table->datetime("commen_at");
            $table->text('comment_text');
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
        Schema::dropIfExists('comments');
    }
};
