<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SacramentType;
use Livewire\WithPagination;

class SacramentTypes extends Component
{
    use WithPagination;

    //public $sacrament_types;
    public $name;
    public $description;
    public $editId;

    public $search = '';
    public $searchType = '';

    protected $updatesQueryString = ['search', 'searchType'];

    protected function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'description' => 'nullable|string',
        ];
    }

    public function mount()
    {
        //$this->sacrament_types = SacramentType::all();
    }

    public function render()
    {
        if($this->searchType == ''){
            return view('livewire.sacrament-types', ['sacrament_types' => SacramentType::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->paginate(10)
        ]);
        }

        return view('livewire.sacrament-types', ['sacrament_types' => SacramentType::query()
            ->where($this->searchType, 'like', '%' . $this->search . '%')
            ->paginate(10)]);
    }

    public function resetInput()
    {
        $this->name = '';
        $this->description = '';
        $this->editId = null;
    }

    // Crear nueva comunidad
    public function store()
    {
        $this->validate();

        SacramentType::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash('message', 'Tipo de sacramento creado.');
        $this->resetInput();
    }

    // Cargar comunidad para editar
    public function edit($id)
    {
        $sacrament_type = SacramentType::findOrFail($id);
        $this->editId = $id;
        $this->name = $sacrament_type->name;
        $this->description = $sacrament_type->description;
    }

    // Actualizar comunidad
    public function update()
    {
        $this->validate();

        if ($this->editId) {
            $sacrament_type = SacramentType::find($this->editId);
            $sacrament_type->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            session()->flash('message', 'Tipo de sacramento actualizado.');
            $this->resetInput();
        }
    }

    // Eliminar comunidad
    public function delete($id)
    {
        SacramentType::find($id)->delete();
        session()->flash('message', 'Tipo de Sacraemnto eliminado.');
    }
}
