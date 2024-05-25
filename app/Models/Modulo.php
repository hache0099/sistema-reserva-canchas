<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Modulo extends Model
{
    use HasFactory;
    protected $table = "Modulo";
    protected $primaryKey = "idModulo";
    public $timestamps = false;

    protected $fillable = [
        'Modulo_descripcion',
        'Modulo_ruta'
    ];
}
