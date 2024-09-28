<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    use HasFactory;
    protected $table = "Socio";

	protected $primaryKey = "id_socio";
	public $timestamps = false;

	protected $fillable = [
	    "rela_usuario",
		"rela_EstadoMemebresia",
		"Socio_fecha_alta",
	];

	protected $casts = [
	    "socio_fecha_alta" => "date:Y-m-d",
	];

	function usuario()
	{
	   return $this->belongsTo(User::class,"rela_usuario");
	}

	function estadomembresia()
	{
	   return $this->belongsTo(EstadoMembresia::class,"rela_EstadoMembresia");
	}

	function preciomembresia()
	{
		return $this->hasMany(PrecioMembresia::class,"rela_socio");
	}

	function precioActual()
	{
		return $this->hasOne(PrecioMembresia::class,"rela_socio")->latest('fecha_desde');
	}
}
