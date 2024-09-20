<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePago extends Model
{
    use HasFactory;
    protected $table = 'DetallePago';
    protected $primaryKey = 'idDetallePago';

    public $timestamps = false;

    protected $fillable = [
        'monto',
        'fecha_hora_pago',
        'rela_reserva',
        'rela_MetodoPago',
    ];

    function reserva()
    {
        return $this->belongsTo(Reserva::class,'rela_reserva');
    }

    function metodopago()
    {
        return $this->belongsTo(MetodoPago::class, 'rela_MetodoPago');
    }
}
