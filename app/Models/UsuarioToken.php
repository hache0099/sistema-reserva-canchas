<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioToken extends Model
{
    use HasFactory;

    protected $table = "UsuarioToken";
    protected $primaryKey = "idUsuarioToken";
    public $timestamps = false;

    protected $fillable = [
        'token_hash',
        'expires_at',
        'activo',
        'rela_usuario',
        'rela_tipotoken',
    ];

    function usuario()
    {
        return $this->belongsTo(User::class,'rela_usuario');
    }

    function tipotoken()
    {
        return $this->belongsTo(TipoToken::class,'rela_tipotoken');
    }
}
