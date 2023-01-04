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
        Schema::create('media_files', function (Blueprint $table) {
			$table->id('id_media_files');
			$table->unsignedBigInteger('id_media_directory')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->string('name');
            $table->string('type');
            $table->string('extension');
			$table->json('params')->nullable();

            $table->foreign('id_media_directory')->references('id_media_directory')->on('media_directory')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_files');
    }
};
