<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_name');
            $table->string('hero_title')->nullable()->default('Welcome to our website');
            $table->string('hero_subtitle')->nullable()->default('Best Services');
            $table->string('statistic_one_number')->nullable()->default('90');
            $table->string('statistic_one_title')->nullable()->default('Charge Dropped');
            $table->string('statistic_two_number')->nullable()->default('90');
            $table->string('statistic_two_title')->nullable()->default('Happy Clients');
            $table->string('statistic_three_number')->nullable()->default('90');
            $table->string('statistic_three_title')->nullable()->default('Trusting Clients');
            $table->string('statistic_four_number')->nullable()->default('20');
            $table->string('statistic_four_title')->nullable()->default('Award Won');
            $table->string('hero_image')->nullable();
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
        Schema::dropIfExists('pages');
    }
}
