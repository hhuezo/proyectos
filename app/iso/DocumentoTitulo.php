<?php

namespace App\iso;

use Illuminate\Database\Eloquent\Model;

class DocumentoTitulo extends Model
{
    protected $table = 'documento_iso_titulo';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'nombre'
    ];

    protected $guarded = [];

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'documento_iso_titulo_id');
    }

}
