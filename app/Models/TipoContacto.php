<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoContacto extends Model
{
    use HasFactory;
    protected $table = "TipoContacto";
    protected $primaryKey = "idContacto";
    public $timestamps = false;

    protected $fillable = [
        'Contacto_descripcion',
        'obligatorio',
        'estado',
    ];
}
