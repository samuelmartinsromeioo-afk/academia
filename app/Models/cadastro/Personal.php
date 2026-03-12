<?php

namespace App\Models\cadastro;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{


    protected $table = 'personals';


    public $timestamps = false;

    protected $fillable = [
        'nome',
        'cpf',
        'cep',
        'rua',
        'bairro',
        'cidade',
        'estado',
        'complemento',
        'senha',
        'email',
        'senha',
        'certificado',
        'resultados',
        'avaliacao',
        'agenda',
        'valor_secao',
        'idade',
    ];
}
