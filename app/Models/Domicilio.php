<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Domicilio extends Model
{
    use HasFactory;
    protected $table = "Domicilio";
    protected $primaryKey = "idDomicilio";
    public $timestamps = false;

    protected $fillable = [
        'Domicilio_detalle',
        'rela_persona'
    ];

    function persona()
    {
        return $this->belongsTo(Persona::class,'rela_persona');
    }

    function tipodomicilio()
    {
        return $this->belongsTo(TipoDomicilio::class,'rela_tipodomicilio');
    }
}
