<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    use HasFactory;

    protected $table = 'MetodoPago';
    protected $primaryKey = 'idMetodoPago';
    public $timestamps = false;

    protected $fillable = [
        'MetodoPago_Descripcion',
        'estado',
    ];
}
