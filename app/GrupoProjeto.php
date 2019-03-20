<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoProjeto extends Model
{
    protected $fillable = [
        'id',
        'idUsuario',
        'idProjeto',
        'respondido',
    ];

    protected $table = "grupo_projetos";
}
