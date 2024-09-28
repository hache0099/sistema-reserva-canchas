<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrecioMembresia extends Model
{
    use HasFactory;
    protected $table = "PrecioMembresia";
    protected $primaryKey = "idPrecioMembresia";
    public $timestamps = false;

    function socio()
    {
        return $this->belongsTo(Socio::class,"rela_socio");
    }
}
