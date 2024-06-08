<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TipoCancha extends Model
{
    use HasFactory;
    protected $table = 'TipoCancha';
    protected $primaryKey = 'idTipoCancha';
    public $timestamps = false;

    protected $fillable = [
        'Material',
    ];

    function cancha() : HasOne
    {
        return $this->hasOne(Cancha::class, 'rela_cancha');
    }
}
