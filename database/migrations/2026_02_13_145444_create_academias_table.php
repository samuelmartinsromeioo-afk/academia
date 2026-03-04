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
        Schema::create('academias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
<<<<<<< HEAD
            $table->string('cep');
            $table->string('rua');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado');
            $table->string('complemento');
            $table->decimal('valor_mensalidade', 10, 2); // Ex: 1500.50
=======
            $table->string('email')->unique();
            $table->string('senha');
            $table->string('endereco');
            $table->decimal('valor', 10, 2); // Ex: 1500.50
>>>>>>> 6330619cb9d55d0e6ec6701728ab6e60e0745d92
            $table->text('descricao');
            $table->string('senha');
            $table->string('cnpj');
            $table->text('tipos_aulas');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academias');
    }
};
