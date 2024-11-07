<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembresiaMes extends Model
{
    use HasFactory;

    protected $table = 'MembresiaMes';
    protected $primaryKey = 'idMembresiaMes';
    public $timestamps = false;

    protected $fillable = [
      'mes',
      'anio',
      'monto_a_pagar',
      'monto_pagado',
      'rela_socio',
      'rela_PrecioMembresia',
    ];

    function socio()
    {
        return $this->belongsTo(Socio::class,'rela_socio');
    }

    function preciomembresia()
    {
        return $this->belongsTo(PrecioMembresia::class,'rela_PrecioMembresia');
    }

}
