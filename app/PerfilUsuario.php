<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerfilUsuario extends Model
{
    protected $fillable = [
        'id',
        'idUsuario',
        'tema',
        'rea',
        'ensino',
        'conhecimento',
        'pratica',
        'formacao',
        'projetos',
        'somatorio',
    ];

    protected $table = "perfil_usuarios";
}
