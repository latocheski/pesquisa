<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questoes extends Model
{
    protected $fillable = [
        'id', 'idArea', 'questao', 'prefixo', 'ativo'
    ];

    protected $table = "questoes";
}
