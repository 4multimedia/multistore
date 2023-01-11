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
        Schema::create('option', function (Blueprint $table) {
            $table->id('id_option');
			$table->unsignedBigInteger('id_option_domain')->nullable();
            $table->timestamps();
			$table->json('key');
            $table->json('value');
			$table->json('id_record')->nullable();
			$table->string('module', 64)->nullable();
            $table->boolean('autoload')->default(0);

			$table->foreign('id_option_domain')->references('id_option_domain')->on('option_domain')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option');
    }
};
