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
        Schema::create('dictionary', function (Blueprint $table) {
			$table->id('id_dictionary');
			$table->unsignedBigInteger('id_dictionary_parent')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('position')->default(0);
			$table->json('name')->nullable();
			$table->json('options')->nullable();

			$table->foreign('id_dictionary_parent')->references('id_dictionary')->on('dictionary')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dictionary');
    }
};
