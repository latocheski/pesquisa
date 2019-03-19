<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvaliacaoQuestionario extends Model
{
    protected $fillable = [
        'id',
        'idUsuario',
        'idQuestao',
        'idArea',  
        'idProjeto',
    ];

    protected $table = "avaliacao_questionarios";
}
