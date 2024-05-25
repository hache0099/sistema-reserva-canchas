<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerfilModulo extends Model
{
    use HasFactory;
    protected $table = "PerfilModulo";
    protected $primaryKey = "idPerfilModulo";
    public $timestamps = false;

    protected $fillable = [
        'Perfil_idPerfil',
        'Modulo_idModulo'
    ];

    function modulo() 
    {
        return $this->belongsTo(Modulo::class,'Modulo_idModulo');
    }

    function perfil()
    {
        return $this->belongsTo(Perfil::class,'Perfil_idPerfil');
    }
}
