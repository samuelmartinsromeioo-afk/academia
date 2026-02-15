<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class login extends Model
{
    protected $table = 'logins';
    protected $fillable = [
        'usuario',
        'senha',
        'tipo_usuario'
    ];
    use HasFactory;
}
