<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $fillable = [
        'id', 'descricao', 'instituicao', 'ativo',
    ];

    protected $table = "projetos";
}
