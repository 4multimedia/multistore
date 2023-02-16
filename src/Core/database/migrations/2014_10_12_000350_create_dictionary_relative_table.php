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
        Schema::create('dictionary_relative', function (Blueprint $table) {
            $table->unsignedBigInteger('id_dictionary');
            $table->unsignedBigInteger('id_record');
            $table->string('table');
			$table->integer('position');

			$table->primary(['id_dictionary', 'id_record', 'table'], 'id_dictionary_to_id_record_table');
			$table->foreign('id_dictionary')->references('id_dictionary')->on('dictionary')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seo');
    }
};
