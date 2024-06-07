<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Persona extends Model
{
    use HasFactory;
    
    protected $table = 'Persona';
    protected $primaryKey = 'id_persona';
    public $timestamps = false;
    
    protected $fillable = [
		"Nombre",
		"Apellido",
		"FechaNacimiento"
    ];

    protected $casts = [
      'FechaNacimiento' => 'datetime:Y-m-d',
    ];

    function personadocumento()
    {
      return $this->hasOne(PersonaDocumento::class, 'Persona_id_persona');
    }

    function domicilio()
    {
      return $this->hasOne(Domicilio::class, 'rela_persona');
    }

    function personacontacto()
    {
      return $this->hasMany(PersonaContacto::class, 'rela_persona');
    }
}
