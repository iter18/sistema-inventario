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
        Schema::create('equipo', function (Blueprint $table) {
            $table->bigIncrements('epo_id');
            $table->string('epo_descripcion', 300);
            $table->string('epo_num_serie', 200)->unique();
            $table->string('epo_modelo', 200) ;
            $table->date('epo_fecha_adquisicion')->nullable();
            $table->boolean('epo_activo_fijo')->nullable();
            $table->string('epo_num_activo', 200)->nullable();
            $table->string('epo_notas', 1000)->nullable();
            $table->boolean('epo_baja')->default(false);
            $table->unsignedBigInteger('epo_tpo_epo_id');
            $table->unsignedBigInteger('epo_mar_id');
            $table->integer('epo_id_usu');
            $table->integer('epo_id_org');

            // Relación con la tabla tipo_equipo
            $table->foreign('epo_tpo_epo_id', 'fk_equipo_tipo_equipo')
                ->references('tpo_epo_id')
                ->on('tipo_equipo');
            // Relación con la tabla marca
            $table->foreign('epo_mar_id', 'fk_equipo_marca')
                ->references('mar_id')
                ->on('marca');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipo');
    }
};
