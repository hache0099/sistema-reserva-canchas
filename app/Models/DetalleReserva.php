<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class DetalleReserva extends Model
{
    use HasFactory;
    
    protected $table = 'DetalleReserva';
    protected $primaryKey = 'id_DetalleReserva';
    public $timestamps = false;
    
    
    function reserva() : BelongsTo
    {
        return $this->belongsTo(Reserva::class, 'rela_reserva');
    }
}
