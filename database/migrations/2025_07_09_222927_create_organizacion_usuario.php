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
        Schema::create('organizacion_usuario', function (Blueprint $table) {
            $table->bigIncrements('org_usu_id');
            $table->unsignedBigInteger('org_usu_org_id');
            $table->unsignedBigInteger('org_usu_usu_id');

            $table->foreign('org_usu_org_id', 'fk_organizacion_usuario_organizacion')
                ->references('org_id')
                ->on('organizacion');
            $table->foreign('org_usu_usu_id', 'fk_organizacion_usuario_usuario')
                ->references('id')
                ->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizacion_usuario');
    }
};
