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
        Schema::create('personals', function (Blueprint $table) {
            $table->id();

            //dados pessoais
            $table->string('nome');
            $table->string('cpf')->unique();
            $table->string('email')->unique();
<<<<<<< HEAD
            $table->string('cep');
            $table->string('rua');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado');
            $table->string('complemento');
=======
            $table->string('senha');
>>>>>>> 6330619cb9d55d0e6ec6701728ab6e60e0745d92
            $table->string('certificado');
            $table->text('resultados');
            $table->text('avaliacao');
            // opções do enum
            $table->enum('agenda', ['disponivel', 'ocupado']);
            $table->decimal('valor_secao', 5, 2); 
            $table->date('idade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personals');
    }
};
