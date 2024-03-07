<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cancha extends Model
{
    use HasFactory;
    
    protected $table = 'Cancha';
    protected $primaryKey = 'id_cancha';
    public $timestamps = false;
    
    function tipocancha()
    {
		return $this->belongsTo(TipoCancha::class,'rela_cancha');
	}
}
