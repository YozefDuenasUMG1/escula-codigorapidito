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
        Schema::create('solicitud_inscripcions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nombre');
            $table->string('email');
            $table->string('numero');
            $table->string('direccion');
            $table->unsignedBigInteger('id_sucursal');
            $table->unsignedBigInteger('id_curso');
            $table->unsignedBigInteger('id_nivel');
            $table->string('estado')->default('pendiente');
            $table->timestamps();

            // Relaciones (puedes comentar si tienes problemas de claves foráneas en Railway)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_sucursal')->references('id_sucursal')->on('sucursales');
            $table->foreign('id_curso')->references('id_curso')->on('cursos');
            $table->foreign('id_nivel')->references('id_nivel')->on('niveles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_inscripcions');
    }
};
