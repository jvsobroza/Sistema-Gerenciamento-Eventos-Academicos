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
        Schema::create('atividades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_evento')->constrained('eventos')->onDelete('cascade');
            $table->string('titulo');
            $table->text('descricao');
            $table->Time('hora_inicio');
            $table->Time('hora_fim');
            $table->string('local');
            $table->integer('vagas');
            $table->string('responsaveis');
            $table->date('data');
            $table->string('tipo');
            $table->string('resumo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atividades');
    }
};
