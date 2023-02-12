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
        Schema::create('navigation', function (Blueprint $table) {
			$table->id('id_navigation');
			$table->unsignedBigInteger('id_navigation_parent')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->dateTime('published_at')->nullable();
			$table->integer('position')->default(0);
			$table->string('label')->nullable();
			$table->string('route', 128)->nullable();
			$table->string('module', 255)->nullable();
			$table->unsignedBigInteger('id_record')->nullable();
            $table->json('params')->nullable();

			$table->foreign('id_navigation_parent')->references('id_navigation')->on('navigation')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('navigation');
    }
};
