<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonaDocumento extends Model
{
    use HasFactory;
    protected $table = "PersonaDocumento";
    protected $primaryKey = "id_PersonaDocumento";
    public $timestamps = false;

    protected $fillable = [
        'PersonaDocumento_desc',
        'Persona_id_persona',
        'TipoDocumento_id_TipoDocumento'
    ];

    function persona()
    {
        return $this->belongsTo(Persona::class,'Persona_id_persona');
    }

    function tipodocumento()
    {
        return $this->belongsTo(TipoDocumento::class,'TipoDocumento_id_TipoDocumento');
    }
}
