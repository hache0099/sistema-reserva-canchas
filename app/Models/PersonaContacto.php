<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonaContacto extends Model
{
    use HasFactory;
    protected $table = "PersonaContacto";
    protected $primaryKey = "id_PersonaContacto";
    public $timestamps = false;

    protected $fillable = [
        'PersonaContacto_desc',
        'rela_persona',
        'rela_contacto'
    ];

    function persona()
    {
        return $this->belongsTo(Persona::class,'rela_persona');
    }

    function tipocontacto()
    {
        return $this->belongsTo(TipoContacto::class,'rela_contacto');
    }
}
