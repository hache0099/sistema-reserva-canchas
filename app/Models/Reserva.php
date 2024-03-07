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
    
    function user()
    {
		return $this->belongsTo(User::class, "rela_usuario");
	}
	
	function detalleres()
	{
		return $this->hasMany(DetalleReserva::class, 'rela_reserva');
	}
}
