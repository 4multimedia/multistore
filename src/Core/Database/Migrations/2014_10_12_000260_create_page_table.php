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
        Schema::create('page', function (Blueprint $table) {
			$table->id('id_page');
			$table->unsignedBigInteger('id_page_parent')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->timestamp('published_at')->nullable();
			$table->integer('position')->default(0);
			$table->json('name');
			$table->json('slug');
			$table->json('excrept')->nullable();
			$table->json('description')->nullable();

			$table->foreign('id_page_parent')->references('id_page')->on('page')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page');
    }
};
