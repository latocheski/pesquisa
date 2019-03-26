<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestoesPerfil extends Model
{
    protected $fillable = [
        'id',
        'questao',
        'ativo',
    ];

    protected $table = "questoes_perfil";
}
