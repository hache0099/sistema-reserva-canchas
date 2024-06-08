<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioCancha extends Model
{
    use HasFactory;

    protected $table = 'HorarioCancha';
    protected $primaryKey = 'idHorarioCancha';
    public $timestamps = false;

    protected $fillable = [
        'hora_desde',
        'hora_hasta',
        'rela_cancha',
    ];

    function cancha()
    {
        return $this->belongsTo(Cancha::class,'rela_cancha');
    }
}
