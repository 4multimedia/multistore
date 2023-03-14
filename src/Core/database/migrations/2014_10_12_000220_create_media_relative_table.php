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
			$table->unsignedBigInteger('id_media_files')->nullable();
			$table->timestamps();
			$table->unsignedBigInteger('id_record');
			$table->string('type', 32)->nullable();
			$table->json('alt')->nullable();
			$table->string('table', 64);
			$table->integer('position')->default(0);
			$table->integer('active')->default(1);

            $table->foreign('id_media_files')->references('id_media_files')->on('media_files')->cascadeOnUpdate()->cascadeOnDelete();
			$table->primary(['id_media_files', 'id_record', 'table', 'type'], 'id_media_files_to_table_record');
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
