<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresoEgreso extends Model
{
    use HasFactory;
    protected $table = 'IngresoEgreso';
    protected $primaryKey = 'idIngresoEgreso';
    public $timestamps = false;

    protected $fillable = [
        'tipo_evento',
        'fecha_hora',
        'rela_reserva',
    ];

    function reserva()
    {
        return $this->belongsTo(Reserva::class,'rela_reserva');
    }
        
}
