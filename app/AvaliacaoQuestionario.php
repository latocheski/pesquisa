<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvaliacaoQuestionario extends Model
{
    protected $fillable = [
        'idUsuario',
        'idQuestao',
        'nota',  
        'idProjeto',
    ];

    protected $table = "avaliacao_questionarios";
}
