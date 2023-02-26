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
        Schema::create('article', function (Blueprint $table) {
            $table->id('id_article');
            $table->timestamps();
			$table->dateTime('published_at')->nullable();
			$table->integer('status')->default(1);
			$table->json('name')->nullable();
			$table->json('slug')->nullable();
			$table->json('excrept')->nullable();
			$table->json('description')->nullable();
			$table->json('options')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article');
    }
};
