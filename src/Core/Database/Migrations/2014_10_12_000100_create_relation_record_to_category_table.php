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
        Schema::create('relation_record_to_category', function (Blueprint $table) {
            $table->unsignedBigInteger('id_record');
            $table->unsignedBigInteger('id_category');
            $table->string('table_name', 64);
			$table->integer('position')->default(0);
			$table->boolean('main')->default(0);

			$table->primary(['id_record', 'id_category', 'table_name'], 'id_record_to_id_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relation_record_to_category');
    }
};
