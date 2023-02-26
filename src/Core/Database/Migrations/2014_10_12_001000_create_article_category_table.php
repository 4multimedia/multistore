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
        Schema::create('article_category', function (Blueprint $table) {
            $table->id('id_article_category');
			$table->unsignedBigInteger('id_article_category_parent')->nullable();
            $table->timestamps();
			$table->dateTime('published_at')->nullable();
			$table->integer('status')->default(1);
			$table->integer('position')->default(0);
			$table->json('name')->nullable();
			$table->json('slug')->nullable();
            $table->json('options')->nullable();

			$table->foreign('id_article_category_parent')->references('id_article_category')->on('article_category')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_category');
    }
};
