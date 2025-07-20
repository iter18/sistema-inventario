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
        Schema::create('departamento', function (Blueprint $table) {
            $table->bigIncrements('dep_id');
            $table->string('dep_nombre', 200);
            $table->string('dep_clave', 100)->unique();
            $table->boolean('dep_baja')->default(true);
            $table->timestamps();
            $table->unsignedBigInteger('dep_org_id');

            $table->foreign('dep_org_id', 'fk_departamento_organizacion')
                ->references('org_id')
                ->on('organizacion');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departamento');
    }
};
