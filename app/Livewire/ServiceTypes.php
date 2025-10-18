<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ServiceType;
use Livewire\WithPagination;

class ServiceTypes extends Component
{
    use WithPagination;

    //public $service_types;
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
        //$this->service_types = ServiceType::all();
    }

    public function render()
    {
        if($this->searchType == ''){
            return view('livewire.service-types', ['service_types' => ServiceType::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->paginate(10)
        ]);
        }

        return view('livewire.service-types', ['service_types' => ServiceType::query()
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

        ServiceType::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash('message', 'Tipo de servicio creado.');
        $this->resetInput();
    }

    // Cargar comunidad para editar
    public function edit($id)
    {
        $service_type = ServiceType::findOrFail($id);
        $this->editId = $id;
        $this->name = $service_type->name;
        $this->description = $service_type->description;
    }

    // Actualizar comunidad
    public function update()
    {
        $this->validate();

        if ($this->editId) {
            $service_type = ServiceType::find($this->editId);
            $service_type->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            session()->flash('message', 'Tipo de servicio actualizado.');
            $this->resetInput();
        }
    }

    // Eliminar comunidad
    public function delete($id)
    {
        ServiceType::find($id)->delete();
        session()->flash('message', 'Tipo de Servicio eliminado.');
    }
}
