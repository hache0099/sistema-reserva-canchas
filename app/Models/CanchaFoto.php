<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanchaFoto extends Model
{
    use HasFactory;

    protected $table = 'CanchaFoto';
    protected $primaryKey = 'idCanchaFoto';
    public $timestamps = false;

    protected $fillable = [
        'CanchaFoto_ruta',
        'Cancha_id_cancha'
    ];

    function cancha()
    {
        return $this->belongsTo(Cancha::class,'Cancha_id_cancha');
    }
}
