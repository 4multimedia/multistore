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
        Schema::create('option_domain', function (Blueprint $table) {
            $table->id('id_option_domain');
            $table->timestamps();
			$table->string('domain')->unique();
			$table->boolean('ssl')->default(0);
            $table->json('options')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option_domain');
    }
};
