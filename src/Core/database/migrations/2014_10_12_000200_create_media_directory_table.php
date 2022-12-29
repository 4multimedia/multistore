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
        Schema::create('media_directory', function (Blueprint $table) {
			$table->id('id_media_directory');
			$table->unsignedBigInteger('id_media_directory_parent')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->string('name');
			$table->json('params')->nullable();

            $table->foreign('id_media_directory_parent')->references('id_media_directory')->on('media_directory')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_directory');
    }
};
