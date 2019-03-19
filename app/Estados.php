<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    protected $fillable = [
        'id',
        'estado'
    ];

    protected $table = "estados";
}
