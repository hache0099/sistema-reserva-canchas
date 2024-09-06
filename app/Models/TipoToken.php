<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoToken extends Model
{
    use HasFactory;

    protected $table = "TipoToken";
    protected $primaryKey = "idTipoToken";
    public $timestamps = false;

    protected $fillable = [
        'descripcion',
    ];
}
