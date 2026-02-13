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
        Schema::create('personal', function (Blueprint $table) {
            $table->id();

            //dados pessoais
            $table->string('nome');
            $table->string('email');
            $table->text('resultados');
            $table->text('avaliacao');

            // opções do enum
            $table->enum('agenda', ['disponivel', 'ocupado']);

            $table->decimal('valor_secao', 5, 2); 
            $table->date('idade'); 
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal');
    }
};
