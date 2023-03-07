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
        Schema::create('user_log', function (Blueprint $table) {
			$table->id('id_user_log');
			$table->unsignedBigInteger('id_user')->nullable();
			$table->timestamps();
			$table->string('module')->nullable();
			$table->bigInteger('id_record')->nullable();
			$table->json('params')->nullable();
			$table->json('changes')->nullable();

            $table->foreign('id_user')->references('id_user')->on('user')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_log');
    }
};
