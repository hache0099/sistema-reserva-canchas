<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reserva extends Model
{
	protected $table = "Reserva";
	
	protected $primaryKey = "id_reserva";
    use HasFactory;
    
    function user()
    {
		return $this->belongsTo(User::class, "rela_usuario");
	}
}
