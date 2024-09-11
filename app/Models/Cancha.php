<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cancha extends Model
{
    use HasFactory;

    protected $table = 'Cancha';
    protected $primaryKey = 'id_cancha';
    public $timestamps = false;

    protected $fillable = [
      'Cancha_cantidad_max_personas',
      'rela_TipoCancha',
      'rela_CanchaEstado',
    ];

    function tipocancha() : BelongsTo
    {
		return $this->belongsTo(TipoCancha::class,'rela_TipoCancha');
	}

    function canchaestado() : BelongsTo
    {
      return $this->belongsTo(CanchaEstado::class,'rela_CanchaEstado');
    }

    function canchafoto()
    {
      return $this->hasMany(CanchaFoto::class,'Cancha_id_cancha');
    }

    function canchahorario()
    {
      return $this->hasOne(HorarioCancha::class,'rela_cancha');
    }

    function preciocancha()
    {
        return $this->hasMany(PrecioCancha::class,'rela_cancha');
    }

    function precioActual()
    {
        return $this->hasOne(PrecioCancha::class,'rela_cancha')->latest('fecha_inicio');
    }
}
