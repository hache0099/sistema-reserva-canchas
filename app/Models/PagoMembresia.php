<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoMembresia extends Model
{
    use HasFactory;

    protected $table = 'PagoMembresia';
    protected $primaryKey = 'idPagoMembresia';
    public $timestamps = false;

    protected $fillable = [
        'Pago_fecha',
        'Pago_monto',
        'rela_EstadoPago',
        'rela_MedioPago',
        'rela_MembresiaMes',
    ];

    function estadopago()
    {
        return $this->belongsTo(EstadoPago::class,'rela_EstadoPago');
    }

    function mediopago()
    {
        return $this->belongsTo(MedioPago::class,'rela_MedioPago');
    }

    function membresiames()
    {
        return $this->belongsTo(MembresiaMes::class,'rela_MembresiaMes');
    }
}
