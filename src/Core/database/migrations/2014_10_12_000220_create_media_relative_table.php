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
        Schema::create('media_relative', function (Blueprint $table) {
			$table->id('id_media_relative');
			$table->unsignedBigInteger('id_media_files')->nullable();
			$table->timestamps();
			$table->unsignedBigInteger('id_record');
			$table->string('name', 64);
			$table->string('table', 64);
			$table->integer('position')->default(0);
			$table->integer('active')->default(1);

            $table->foreign('id_media_files')->references('id_media_files')->on('media_files')->cascadeOnUpdate()->cascadeOnDelete();
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
