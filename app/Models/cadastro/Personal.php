<?php

namespace App\Models\cadastro;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
<<<<<<< HEAD
    
=======
    // Informamos que a tabela não segue o padrão plural (personals)
>>>>>>> 6330619cb9d55d0e6ec6701728ab6e60e0745d92
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
        'idade'
    ];
}
