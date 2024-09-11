<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrecioCancha extends Model
{
    use HasFactory;
    protected $table = 'PrecioCancha';
    protected $primaryKey = 'idPrecioCancha';
    public $timestamps = false;

    protected $fillable = [
        'precio',
        'fecha_inicio',
        'fecha_fin',
        'rela_cancha',
    ];

    protected $casts = [
        'fecha_inicio' => 'date:Y-m-d',
        'fecha_fin' => 'date:Y-m-d',
    ];

    function cancha()
    {
        return $this->belongsTo(Cancha::class,'rela_cancha');
    }
}
