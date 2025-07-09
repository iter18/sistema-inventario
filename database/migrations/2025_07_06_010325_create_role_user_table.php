<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->bigIncrements('rusu_id');
            $table->unsignedBigInteger('rusu_usu_id');
            $table->unsignedBigInteger('rusu_rol_id');

            $table->foreign('rusu_usu_id','fk_role_user_usuario')
                ->references('id')
                ->on('users');
            $table->foreign('rusu_rol_id','fk_role_user_role')
                ->references('role_id')
                ->on('roles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
