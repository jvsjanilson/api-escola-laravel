<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsaveis extends Model
{
    use HasFactory;
    public $fillable = [
        'nome',
        'tipo_logradouro',
        'logradouro',
        'numero',
        'complemento',
        'cep',
        'bairro',
        'estado_id',
        'cidade_id',
        'telefone',
        'celular',
        'email',
        'ativo',
    ];

    /** Relacionamento */


    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }
}
