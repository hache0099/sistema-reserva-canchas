<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Perfil extends Model
{
    use HasFactory;
    protected $table = "Perfil";
    protected $primaryKey = "idPerfil";
    public $timestamps = false;

    protected $fillable = [
        'Perfil_descripcion'
    ];

    function perfilmodulo()
    {
        return $this->hasMany(PerfilModulo::class, 'Perfil_idPerfil');
    }
}
