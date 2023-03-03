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
        Schema::create('relation_record_to_record', function (Blueprint $table) {
            $table->unsignedBigInteger('id_record_primary');
            $table->unsignedBigInteger('id_record');
            $table->string('table_name_parent', 64);
            $table->string('table_name', 64);
			$table->string('type');

			$table->primary(['id_record_primary', 'id_record', 'table_name', 'table_name_parent', 'type'], 'id_record_to_id_record');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relation_record_id_record');
    }
};
