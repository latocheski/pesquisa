<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerfilUsuario extends Model
{
    protected $fillable = [
        'id',
        'idUsuario',
        'idQuestaoPerfil',
        'nota'
    ];

    protected $table = "perfil_usuarios";
}
