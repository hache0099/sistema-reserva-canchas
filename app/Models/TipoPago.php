<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    use HasFactory;
    
    protected $table = "TipoPago";
    protected $primaryKey = "idTipoPago";
    public $timestamps = false;

    protected $fillable = [
        'TipoPago_desc',
        'estado',
    ];
}
