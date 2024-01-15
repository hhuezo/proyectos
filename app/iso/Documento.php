<?php

namespace App\iso;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documento_iso';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'nombre',
        'documento_iso_titulo_id',
        'ruta'
    ];

    protected $guarded = [];

    public function titulo()
    {
        return $this->belongsTo(DocumentoTitulo::class, 'documento_iso_titulo_id');
    }
}
