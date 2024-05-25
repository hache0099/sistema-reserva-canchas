<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;
    protected $table = "Perfil";
    protected $primaryKey = "idPerfil";
    public $timestamps = false;

    protected $fillable = [
        'Perfil_descripcion'
    ];
}
