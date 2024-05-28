<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reserva extends Model
{
	protected $table = "Reserva";
	
	protected $primaryKey = "id_reserva";
	public $timestamps = false;
    use HasFactory;

	protected $fillable = [
		'Reserva_fecha',
		'Reserva_hora',
		'rela_ReservaEstado',
		'rela_usuario',
		'rela_cancha'
	];
    
    function user()
    {
		return $this->belongsTo(User::class, "rela_usuario");
	}
	
	function cancha()
	{
		return $this->belongsTo(Cancha::class,'rela_cancha');
	}
}
