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
        Schema::create('cliente', function (Blueprint $table) {
            // Dados Pessoais 
            $table->string('nome');
            $table->string('email')->unique();
            $table->decimal('altura', 3, 2); 
            $table->decimal('peso', 5, 2);   
            $table->date('idade'); 
            
            // Frequência e Objetivos
            $table->integer('frequencia_semanal');
            $table->text('resumo_objetivo');
            $table->text('condicao_clinica');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
