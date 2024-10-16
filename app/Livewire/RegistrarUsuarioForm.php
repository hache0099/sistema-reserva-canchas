<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\User;
use App\Models\Persona;
use App\Models\Domicilio;
use App\Models\TipoDomicilio;
use App\Models\TipoDocumento;
use App\Models\TipoContacto;
use App\Models\PersonaDocumento;
use App\Models\PersonaContacto;
use App\Models\Perfil;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegistrarUsuarioForm extends Component
{
    public $esPerfilModificable;
    
    public $tipodni;
    public $dni;
    public $nombre;
    public $apellido;
    public $email;

    // Reglas de validación
    protected $rules = [
        'dni' => 'required|numeric|unique:personas,dni',
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'email' => 'required|email|unique:usuarios,email',
        'tipodni' => 'required|number',
    ];


    function mount($perfil = null, $perfilModificable = false)
    {
        $this->perfil = $perfil;
        $this->esPerfilModificable = $perfilModificable;
    }

    public function saveUsuario()
    {
        // Validar los datos del formulario
        $this->validate();

        try {

            // Iniciar transacción para asegurar que ambos procesos (usuario y reserva) ocurran juntos
            DB::beginTransaction();
            // Crear persona
            $persona = Persona::create([
                'Nombre' => $this->nombre,
                'Apellido' => $this->apellido,
            ]);

            $domicilio = Domicilio::create([
				'rela_persona' => $persona->id_persona,
			]);

			$persona_doc = PersonaDocumento::create([
				'PersonaDocumento_desc' => $this->dni,
				'Persona_id_persona' => $persona->id_persona,
				'TipoDocumento_id_TipoDocumento' => $this->tipodni,
			]);

			$persona_contacto = PersonaContacto::create([
				'PersonaContacto_desc' => "",
				'rela_persona' => $persona->id_persona,
				'rela_tipocontacto' => TipoContacto::where('Contacto_descripcion', 'Telefono')
					->first()->idContacto,
			]);
            
            // Crear usuario asociado
            $usuario = Usuario::create([
                'email' => $this->email,
                'rela_persona' => $persona->id_persona,
                'password' => Hash::make($this->dni), // Contraseña por defecto (puedes modificarla)
            ]);

            // Confirmar la transacción
            DB::commit();

            // Emitir evento para notificar que el usuario fue creado y pasar el ID del nuevo usuario
            $this->emit('usuarioCreado', $usuario->id_usuario);

            session()->flash('message', 'Usuario creado exitosamente.');

        } catch (\Exception $e) {
            // Revertir transacción si ocurre un error
            DB::rollback();

            session()->flash('error', 'Ocurrió un error al crear el usuario: ' . $e->getMessage());
        }
    }
    
    
    public function render()
    {
        return view('livewire.registrar-usuario-form');
    }
}
