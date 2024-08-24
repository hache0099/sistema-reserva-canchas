<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservaEstado extends Model
{
    protected $table = "ReservaEstado";
	
	protected $primaryKey = "idReservaEstado";
	public $timestamps = false;
    use HasFactory;

    
}
