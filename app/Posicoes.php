<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posicoes extends Model
{
    protected $table = "posicoes";

    protected $fillable = [
        'latitude', 'longitude',
    ];
}
