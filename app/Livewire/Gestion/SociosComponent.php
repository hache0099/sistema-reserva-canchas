<?php

namespace App\Livewire\Gestion;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On; 

use App\Models\Socio;
use App\Models\MembresiaMes;
use App\Model\User;

class SociosComponent extends Component
{

    use WithPagination;
    
    //public $socios;
    public $socioId;
    public $showModal = false;

    public $selectedSocioId;

    public $search = '';
    public $perPage = 10;

    
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['openModal' => 'showModal', 'closeModal' => 'hideModal'];

    function mount()
    {
    }

    //#[On('openModal')]
    public function showModalFunc($socioId)
    {
        $this->selectedSocioId = $socioId;

        $this->showModal = true;
    }

    public function hideModal()
    {
        $this->showModal = false;
    }
    
    public function render()
    {
        $socios = Socio::with(['usuario.persona', 'usuario.persona.personadocumento'])
            ->whereHas('usuario.persona.personadocumento', function($query) {
                $query->where('PersonaDocumento_desc', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('usuario.persona', function($query) {
                $query->where('Nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('Apellido', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);
        
        return view('livewire.gestion.socios-component',compact('socios'))
            ->extends('layout.mainlayout')
            ->section('content');
    }
}
