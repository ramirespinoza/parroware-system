<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Community;

class Communities extends Component
{
    public $communities;
    public $name;
    public $description;
    public $coordinatorId;
    public $subCoordinatorId;
    public $editId;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'description' => 'nullable|string',
            'coordinatorId' => 'nullable|string',
            'subCoordinatorId' => 'nullable|string'
        ];
    }

    public function mount()
    {
        $this->communities = Community::all();
    }

    public function render()
    {
        return view('livewire.communities');
    }

    public function resetInput()
    {
        $this->name = '';
        $this->description = '';
        $this->coordinatorId = 0;
        $this->subCoordinatorId = 0;
        $this->editId = null;
    }

    // Crear nueva comunidad
    public function store()
    {
        $this->validate();

        Community::create([
            'name' => $this->name,
            'description' => $this->description,
            'coordinator_id' => $this->coordinatorId,
            'subcoordinator_id' => $this->subCoordinatorId,
        ]);

        session()->flash('message', 'Community created successfully.');
        $this->resetInput();
    }

    // Cargar comunidad para editar
    public function edit($id)
    {
        $community = Community::findOrFail($id);
        $this->editId = $id;
        $this->name = $community->name;
        $this->description = $community->description;
        $this->coordinatorId = $community->coordinatorId;
        $this->subCoordinatorId = $community->subCoordintarId;
    }

    // Actualizar comunidad
    public function update()
    {
        $this->validate();

        if ($this->editId) {
            $community = Community::find($this->editId);
            $community->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            session()->flash('message', 'Community updated successfully.');
            $this->resetInput();
        }
    }

    // Eliminar comunidad
    public function delete($id)
    {
        Community::find($id)->delete();
        session()->flash('message', 'Community deleted successfully.');
    }

}
