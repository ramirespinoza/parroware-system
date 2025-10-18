<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pay;
use App\Models\ServiceType;
use App\Models\Parishioner;

class Pays extends Component
{
    public $pays;
    public $serviceTypeId;
    public $parishionerId;
    public $payDate;
    public $ammount;
    public $editId;

    public $serviceTypes;
    public $parishioners;

    protected function rules()
    {
        return [
            'serviceTypeId' => 'required|integer',
            'parishionerId' => 'required|integer',
            'payDate' => 'required|date',
            'ammount' => 'required',
        ];
    }

    public function mount()
    {
        $this->pays = Pay::with('parishioner', 'serviceType')->get();
        $this->serviceTypes = ServiceType::all();
        $this->parishioners = Parishioner::all();
    }

    public function render()
    {
        return view('livewire.pays');
    }

    public function resetInput()
    {
        $this->serviceTypeId = '';
        $this->parishionerId = '';
        $this->payDate = '';
        $this->editId = null;
    }

    // Crear nueva comunidad
    public function store()
    {
        $this->validate();

        Pay::create([
            'service_type_id' => $this->serviceTypeId,
            'parishioner_id' => $this->parishionerId,
            'pay_date' => $this->payDate,
            'ammount' => $this->ammount,
        ]);

        session()->flash('message', 'Pago creado.');
        $this->resetInput();
    }

    // Cargar comunidad para editar
    public function edit($id)
    {
        $pay = Pay::findOrFail($id);
        $this->editId = $id;
        $this->serviceTypeId = $pay->service_type_id;
        $this->parishionerId = $pay->parishioner_id;
        $this->payDate = $pay->pay_date;
        $this->ammount = $pay->ammount;
    }

    // Actualizar comunidad
    public function update()
    {
        $this->validate();

        if ($this->editId) {
            $sacrament_type = Pay::find($this->editId);
            $sacrament_type->update([
                'service_type_id' => $this->serviceTypeId,
                'parishioner_id' => $this->parishionerId,
                'pay_date' => $this->payDate,
                'ammount' => $this->ammount,
            ]);

            session()->flash('message', 'Pago actualizado.');
            $this->resetInput();
        }
    }

    // Eliminar comunidad
    public function delete($id)
    {
        Pay::find($id)->delete();
        session()->flash('message', 'Pago eliminado.');
    }
}
