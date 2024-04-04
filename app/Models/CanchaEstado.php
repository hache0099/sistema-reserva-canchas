<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CanchaEstado extends Model
{
    use HasFactory;

    protected $table = 'CanchaEstado';
    protected $primaryKey = 'idCanchaEstado';
    public $timestamps = false;

    function cancha() : BelongsTo
    {
        return $this->belongsTo(Cancha::class,'rela_cancha');
    }
}
