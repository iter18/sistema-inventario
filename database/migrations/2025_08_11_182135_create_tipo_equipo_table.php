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
        Schema::create('tipo_equipo', function (Blueprint $table) {
            $table->bigIncrements('tpo_epo_id');
            $table->string('tpo_epo_descripcion', 100);
            $table->boolean('tpo_epo_baja', 100)->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_equipo');
    }
};
