<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDomicilio extends Model
{
    use HasFactory;
    protected $table = "TipoDomicilio";
    protected $primaryKey = "idTipoDomicilio";
    public $timestamps = false;

    protected $fillable = [
        'TipoDomicilio_desc',
        'estado',
    ];

    function domicilio()
    {
        return $this->hasOne(Domicilio::class,'rela_tipodomicilio');
    }
}
