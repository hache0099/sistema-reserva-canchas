<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PorcentajeSena extends Model
{
    use HasFactory;
    protected $table = "PorcentajeSena";
    protected $primaryKey = "idPorcentajeSena";
    public $timestamps = false;
}
