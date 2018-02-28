<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Object extends Model
{
    protected $table = "object";

    protected $fillable = [
        'name',
        'descricao',
        'latitude',
        'longitude',
    ];

    protected $primaryKey = "id";
}
