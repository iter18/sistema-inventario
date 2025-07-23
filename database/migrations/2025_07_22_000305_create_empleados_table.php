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
        Schema::create('empleados', function (Blueprint $table) {
            $table->bigIncrements('emp_id');
            $table->string('emp_nombre', 200);
            $table->string('emp_numero', 100)->unique();
            $table->string('emp_correo', 150)->unique();
            $table->date('emp_fecha_ingreso'); // Formato YYYY-MM-DD
            $table->date('emp_fecha_baja')->nullable(); // Formato YYYY-MM-DD, nullable para empleados activos
            $table->boolean('emp_baja')->default(false);
            $table->integer('emp_id_usu'); // ID del usuario que creó el registro
            $table->integer('emp_org_id'); // ID de la organizació
            $table->unsignedBigInteger('emp_dep_id');
            // Relación con la tabla departamento
            $table->foreign('emp_dep_id', 'fk_empleado_departamento')
                ->references('dep_id')
                ->on('departamento'); // Eliminar empleados si se elimina el departamento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
