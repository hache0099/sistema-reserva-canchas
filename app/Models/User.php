<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'Usuario';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;
    protected $fillable = [
        //~ 'name',
        'email',
        'password',
        'fecha_alta',
        'rela_persona',
        'rela_perfil'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        //~ 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_alta' => 'date',
        'password' => 'hashed',
    ];
    
    function persona() {
		return $this->belongsTo(Persona::class, "rela_persona");
	}
	
    function perfil()
    {
        return $this->belongsTo(Perfil::class,'rela_perfil');
    }

	function reservas()
	{
		return $this->hasMany(Reserva::class, "rela_usuario");
	}

    // function getAuthPassword()
    // {
    //     return $this->pass;
    // }
}
