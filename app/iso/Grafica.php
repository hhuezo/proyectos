<?php

namespace App\iso;

use Illuminate\Database\Eloquent\Model;

class Grafica extends Model
{
    protected $table = 'grafica';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'grafica_id',
        'codigo',
        'valor'
    ];
}
