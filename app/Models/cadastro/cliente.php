<?php

namespace App\cadastro\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'altura',
        'peso',
        'idade',
        'sexo',
        'frequencia_semanal',
        'resumo_objetivo',
        'condicao_clinica'
        ];
    use HasFactory;
}
