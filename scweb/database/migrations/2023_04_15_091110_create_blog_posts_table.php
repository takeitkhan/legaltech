<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('excerpt')->nullable();
            $table->longText('body');
            $table->boolean('published')->default(false);
            $table->dateTime('publish_date')
                ->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->string('featured_image')->nullable();
            $table->string('featured_image_caption');
            $table->longText('meta')->nullable();
            $table->unsignedBigInteger('category_id')->unsigned();
            $table->unsignedBiginteger('admin_id')->unsigned();

            $table->foreign('category_id')->references('id')
                ->on('blog_categories')->onDelete('cascade');

            $table->foreign('admin_id')->references('id')
                ->on('admins')->onDelete('cascade');

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
        Schema::dropIfExists('blog_posts');
    }
}