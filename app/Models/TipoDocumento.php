<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;
    protected $table = "TipoDocumento";
    protected $primaryKey = "id_TipoDocumento";
    public $timestamps = false;

    protected $fillable = [
        'TipoDocumento_desc',
        'estado',
    ];
}
