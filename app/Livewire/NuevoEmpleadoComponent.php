<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\User;
use App\Models\Empleado;

class NuevoEmpleadoComponent extends Component
{
    public $search = '';  // Campo de búsqueda

    public function cargarTodosLosEmpleados()
    {
        // Unimos tablas para obtener los datos necesarios
        return User::join('Persona', 'Usuario.rela_persona', '=', 'Persona.id_persona')
            ->join('PersonaDocumento', 'Persona.id_persona', '=', 'PersonaDocumento.Persona_id_Persona')
            ->join('TipoDocumento', 'PersonaDocumento.TipoDocumento_id_TipoDocumento', '=', 'TipoDocumento.id_TipoDocumento')
            ->where('TipoDocumento.TipoDocumento_desc', 'DNI') // Filtrar solo por DNI
            ->select('Usuario.id_usuario', 'Persona.Nombre', 'Persona.Apellido', 'PersonaDocumento.PersonaDocumento_desc as dni', 'Usuario.email')
            ->get();
    }

    public function buscarPorCriterio()
    {
        // Búsqueda por DNI si hay algo en el campo de búsqueda
        return User::join('Persona', 'Usuario.rela_persona', '=', 'Persona.id_persona')
            ->join('PersonaDocumento', 'Persona.id_persona', '=', 'PersonaDocumento.Persona_id_Persona')
            ->join('TipoDocumento', 'PersonaDocumento.TipoDocumento_id_TipoDocumento', '=', 'TipoDocumento.id_TipoDocumento')
            ->where('TipoDocumento.TipoDocumento_desc', 'DNI')
            ->where('PersonaDocumento.PersonaDocumento_desc', 'like', '%' . $this->search . '%')
            ->select('Usuario.id_usuario', 'Persona.Nombre', 'Persona.Apellido', 'PersonaDocumento.PersonaDocumento_desc as dni', 'Usuario.email')
            ->get();
    }

    public function render()
    {
        // Obtener los usuarios con búsqueda de DNI
        $usuarios = !empty($this->search) ? $this->buscarPorCriterio() : $this->cargarTodosLosEmpleados();

        return view('livewire.nuevo-empleado-component', [
            'usuarios' => $usuarios  // Pasamos los usuarios a la vista
        ])
        ->extends('layout.mainlayout')
            ->section('content');
    }

    // Añadir un empleado a un usuario existente
    public function agregarEmpleado($idUsuario)
    {
        // Validación para evitar que se añadan empleados duplicados (esto es opcional según tu lógica de negocio)
        $existe = Empleado::where('rela_usuario', $idUsuario)->exists();

        if ($existe) {
            session()->flash('error', 'El usuario ya tiene un empleado asignado.');
        } else {
            Empleado::create([
                'rela_usuario' => $idUsuario,
                'fecha_alta_empleado' => now()->format('Y-m-d'),
                'codigo_legajo' => $this->generarCodigoLegajo(),
            ]);

            session()->flash('success', 'Empleado añadido con éxito.');
        }

        return redirect('/gestion/empleados/');  // Redirigir a la lista de empleados
    }

    // Función para generar código de legajo (ejemplo básico)
    private function generarCodigoLegajo()
    {
        return 'EMP-' . strtoupper(uniqid());
    }

    // Redirigir a la página de creación de usuario
    public function crearNuevoUsuario()
    {
        return redirect('/gestion/usuario/create?perfilACrear=2');
    }
}

