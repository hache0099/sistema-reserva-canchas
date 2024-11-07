<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empleado; // Suponiendo que tienes el modelo Empleado y Persona relacionados
use App\Models\Persona;

class EmpleadosComponent extends Component
{
    public $search = '';  // Campo de búsqueda

    public function render()
    {
        $empleados = Empleado::join('Usuario', 'Empleado.rela_usuario', '=', 'Usuario.id_usuario')
            ->join('Persona', 'Usuario.rela_persona', '=', 'Persona.id_persona')
            ->join('PersonaDocumento', 'Persona.id_persona', '=', 'PersonaDocumento.Persona_id_Persona')
            ->join('TipoDocumento', 'PersonaDocumento.TipoDocumento_id_TipoDocumento', '=', 'TipoDocumento.id_TipoDocumento')
            ->where('TipoDocumento.TipoDocumento_desc', 'DNI') // Aseguramos que sea un DNI
            ->when($this->search, function ($query) {
                // Si hay una búsqueda, aplicar los filtros
                $query->where('Empleado.codigo_legajo', 'like', '%' . $this->search . '%')
                    ->orWhere('PersonaDocumento.PersonaDocumento_desc', 'like', '%' . $this->search . '%');
            })
            ->select('Empleado.codigo_legajo', 'Persona.Nombre', 'Persona.Apellido', 'PersonaDocumento.PersonaDocumento_desc as dni', 'Empleado.fecha_alta_empleado')
            ->get();

        return view('livewire.empleados-component', [
            'empleados' => $empleados
        ])
        ->extends('layout.mainlayout')
            ->section('content');
    }

    // Función para buscar empleados según el DNI o código de legajo
    public function updatedSearch()
    {
        // El render automáticamente actualizará la lista
        $this->render();
    }

    // Función para redirigir a la página de creación de empleados
    public function crearEmpleado()
    {
        return redirect('/gestion/empleados/create');  // Ruta a definir en tu sistema
    }
}
