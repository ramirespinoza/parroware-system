<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AssignedSacrament;
use App\Models\Parishioner;
use App\Models\SacramentType;
use App\Models\Priest;

class AssignedSacraments extends Component
{
    public $assignedSacraments;
    public $sacramentTypeId;
    public $parishionerId;
    public $scheduledDate;
    public $assignedSacramentStatus;
    public $priestId;
    public $editId;

    public $sacramentTypes;
    public $parishioners;
    public $priests;

    protected function rules()
    {
        return [
            'sacramentTypeId' => 'required|integer',
            'parishionerId' => 'required|integer',
            'scheduledDate' => 'required|date',
            'assignedSacramentStatus' => 'required',
            'priestId' => 'required|integer',
        ];
    }

    public function mount()
    {
        $this->assignedSacraments = AssignedSacrament::with('sacramentType', 'parishioner', 'priest')->get();
        $this->sacramentTypes = SacramentType::all();
        $this->parishioners = Parishioner::all();
        $this->priests = Priest::all();

    }

    public function render()
    {
        return view('livewire.assigned-sacrament');
    }

    public function resetInput()
    {
        $this->sacramentTypeId = '';
        $this->parishionerId = '';
        $this->scheduledDate = '';
        $this->assignedSacramentStatus = '';
        $this->priestId = '';
        $this->editId = null;
    }

    // Crear nueva comunidad
    public function store()
    {
        $this->validate();

        AssignedSacrament::create([
            'sacrament_type_id' => $this->sacramentTypeId,
            'parishioner_id' => $this->parishionerId,
            'scheduled_date' => $this->scheduledDate,
            'assigned_sacrament_status' => $this->assignedSacramentStatus,
            'priest_id' => $this->priestId,
        ]);

        session()->flash('message', 'Asignación de Sacramento creada.');
        $this->resetInput();
    }

    // Cargar comunidad para editar
    public function edit($id)
    {
        $assignedSacrament = AssignedSacrament::findOrFail($id);
        $this->editId = $id;
        $this->sacramentTypeId = $assignedSacrament->sacrament_type_id;
        $this->parishionerId = $assignedSacrament->parishioner_id;
        $this->scheduledDate = $assignedSacrament->scheduled_date;
        $this->assignedSacramentStatus = $assignedSacrament->assigned_sacrament_status;
        $this->priestId = $assignedSacrament->priest_id;


    }

    // Actualizar comunidad
    public function update()
    {
        $this->validate();

        if ($this->editId) {
            $sacrament_type = AssignedSacrament::find($this->editId);
            $sacrament_type->update([
                'sacrament_type_id' => $this->sacramentTypeId,
                'parishioner_id' => $this->parishionerId,
                'scheduled_date' => $this->scheduledDate,
                'assigned_sacrament_status' => $this->assignedSacramentStatus,
                'priest_id' => $this->priestId,
            ]);

            session()->flash('message', 'Sacramento asignado actualizado.');
            $this->resetInput();
        }
    }

    // Eliminar comunidad
    public function delete($id)
    {
        AssignedSacrament::find($id)->delete();
        session()->flash('message', 'Sacramento Asignado eliminado.');
    }
}
