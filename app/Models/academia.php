<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class academia extends Model
{
    protected $table ='academia';

    protected $fillable = [
        'nome',
        'endereco',
        'valor',
        'descricao',
        'infraestrutura',
        'tipos_aulas'
                            ];

    //garante com que os dados saiam de forma correta do banco de dados 
    protected $casts = [
        'valor' => 'decimal:2',
        'created_at' => 'datetime',
    ];
    public function cliente(): HasMany
    {
        return $this->hasMany(cliente::class);
    }
   
    use HasFactory;
}
