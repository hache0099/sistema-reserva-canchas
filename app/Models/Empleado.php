<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $table = "Empleado";
    protected $primaryKey = "idEmpleado";
    public $timestamps = false;

    protected $fillable = [
        'codigo_legajo',
        'fecha_alta_empleado',
        'fecha_baja_empleado',
        'rela_usuario',
    ];

    function usuario()
    {
        return $this->belongsTo(User::class,'rela_usuario');
    }
}
