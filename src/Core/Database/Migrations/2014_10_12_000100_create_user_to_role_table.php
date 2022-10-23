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
        Schema::create('user_to_role', function (Blueprint $table) {
			$table->unsignedBigInteger('id_user');
			$table->unsignedBigInteger('id_user_role');

            $table->primary(['id_user', 'id_user_role']);

            $table->foreign('id_user_role')->references('id_user_role')->on('user_role')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('user');
    }
};
