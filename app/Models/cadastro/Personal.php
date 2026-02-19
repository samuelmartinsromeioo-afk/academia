<?php

namespace App\cadastro\Models;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    // Informamos que a tabela não segue o padrão plural (personals)
    protected $table = 'personal';

    // Desativamos timestamps caso sua migration não tenha $table->timestamps()
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'cpf',
        'email',
        'certificado',
        'resultados',
        'avaliacao',
        'agenda',
        'valor_secao',
        'idade'
    ];
}
