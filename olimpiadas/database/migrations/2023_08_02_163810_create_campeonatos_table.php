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
        Schema::create('campeonatos', function (Blueprint $table) {
            $table->id();
            $table->string('nome',50);
            $table->unsignedTinyInteger('primeiroLugar')->nullable();
            $table->unsignedTinyInteger('segundoLugar')->nullable();
            $table->unsignedTinyInteger('terceiroLugar')->nullable();
            $table->unsignedTinyInteger('quantidadeClassificados')->nullable();
            $table->unsignedTinyInteger('timesPorEquipe');
            $table->foreignId('tipo_id')->constrained('tipos')->onDelete('cascade');
            $table->foreignId('modalidade_id')->constrained('modalidades')->onDelete('cascade');
            $table->foreignId('especialidade_id')->constrained('especialidades')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campeonatos');
    }
};
