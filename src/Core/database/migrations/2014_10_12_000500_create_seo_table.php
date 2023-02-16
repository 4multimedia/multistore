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
        Schema::create('seo', function (Blueprint $table) {
			$table->id('id_seo');
			$table->timestamps();
			$table->softDeletes();
			$table->unsignedBigInteger('id_record');
			$table->string('table', 64);
			$table->json('title')->nullable();
			$table->json('meta')->nullable();
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
