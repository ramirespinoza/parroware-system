<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Certificate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Certificates extends Component
{
    use WithFileUploads;
    public $certificates;
    public $certificate;
    public $certificatePath;
    public $selectedCertificate;
    public $isueDate;
    public $assignedSacramentId;
    public $editId;

    protected function rules()
    {
        return [
            'certificate' => 'required',
            'isueDate' => 'required|date',
            'assignedSacramentId' => 'required|integer',
        ];
    }

    public function mount()
    {
        $this->certificates = Certificate::all();
    }

    public function render()
    {
        return view('livewire.certificates');
    }

    public function resetInput()
    {
        $this->certificate = '';
        $this->isueDate = '';
        $this->assignedSacramentId = '';
        $this->editId = null;
    }

    // Crear nueva comunidad
    public function store()
    {
        $this->validate();

        $this->certificatePath = $this->certificate->store('certificates', 'public');

        Certificate::create([
            'certificate' => $this->certificatePath,
            'isue_date' => $this->isueDate,
            'assigned_sacrament_id' => $this->assignedSacramentId,
        ]);

        session()->flash('message', 'Certificado almacenado.');
        $this->resetInput();
    }

    // Cargar comunidad para editar
    public function edit($id)
    {
        $certificate = Certificate::findOrFail($id);
        $this->editId = $id;
        $this->certificate = Storage::get('storage/app/public/' . $certificate->certificate);
        $this->isueDate = $certificate->isue_date;
        $this->assignedSacramentId = $certificate->assigned_sacrament_id;
    }

    // Actualizar comunidad
    public function update()
    {
        $this->validate();

        if ($this->editId) {
            $certificate = Certificate::find($this->editId);

            $this->certificatePath = $this->certificate->store('certificates', 'public');

            $certificate->update([
                'certificate' => $this->certificatePath,
                'isue_date' => $this->isueDate,
                'assigned_sacrament_id' => $this->assignedSacramentId,
            ]);

            session()->flash('message', 'Certificado actualizado.');
            $this->resetInput();
        }
    }

    // Eliminar comunidad
    public function delete($id)
    {
        Certificate::find($id)->delete();
        session()->flash('message', 'Certificado eliminado.');
    }

    public function viewCertificate($id)
    {
        $this->selectedCertificate = Certificate::find($id);
    }

    public function closeViewer()
    {
        $this->selectedCertificate = null;
    }
}
