<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_profesor')->nullable()->after('id_curso');
            $table->foreign('id_profesor')->references('id_profesor')->on('profesores')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table->dropForeign(['id_profesor']);
            $table->dropColumn('id_profesor');
        });
    }
}; 