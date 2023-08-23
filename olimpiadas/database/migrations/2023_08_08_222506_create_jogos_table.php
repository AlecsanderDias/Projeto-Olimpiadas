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
        Schema::create('jogos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campeonato_id')->constrained('campeonatos')->nullable();
            $table->string('nome',60);
            $table->date('data')->nullable();
            $table->foreignId('casa')->nullable()->constrained('times');
            $table->foreignId('adversario')->nullable()->constrained('times');
            $table->char('resultadoCasa')->nullable();
            $table->char('resultadoAdversario')->nullable();
            $table->unsignedTinyInteger('placarCasa')->nullable();
            $table->unsignedTinyInteger('placarAdversario')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jogos');
    }
};
