<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DetalleReserva extends Model
{
    use HasFactory;
    
    protected $table = 'DetalleReserva';
    protected $primaryKey = 'id_DetalleReserva';
    public $timestamps = false;
}
