<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $fillable = [
        'id', 'descricao', 'instituicao',
    ];

    protected $table = "projetos";
}
