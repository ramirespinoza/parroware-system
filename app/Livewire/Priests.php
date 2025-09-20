<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Priest;

class Priests extends Component
{
    public $priests;
    public $dpi;
    public $name;
    public $lastName;
    public $birthday;
    public $address;
    public $phoneNumber;
    public $email;
    public $editId;

    protected function rules()
    {
        return [
            'dpi' => 'required|integer|min:3',
            'name' => 'required|string|min:3',
            'lastName' => 'nullable|string',
            'birthday' => 'nullable|date',
            'address' => 'nullable|string',
            'phoneNumber' => 'nullable|integer',
            'email' => 'nullable|string',
        ];
    }

    public function mount()
    {
        $this->priests = Priest::all();
    }

    public function render()
    {
        return view('livewire.priests');
    }


    public function resetInput()
    {
        $this->dpi = 0;
        $this->name = '';
        $this->lastName = '';
        $this->birthday = '';
        $this->address = '';
        $this->phoneNumber = '';
        $this->email = '';
        $this->editId = null;
    }

    // Crear nueva comunidad
    public function store()
    {
        $this->validate();

        Priest::create([
            'dpi' => $this->dpi,
            'name' => $this->name,
            'last_name' => $this->lastName,
            'birthday' => $this->birthday,
            'address' => $this->address,
            'phone_number' => $this->phoneNumber,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Feligres created successfully.');
        $this->resetInput();
    }

    // Cargar comunidad para editar
    public function edit($id)
    {
        $priest = Priest::findOrFail($id);
        $this->editId = $id;
        $this->dpi = $priest->dpi;
        $this->name = $priest->name;
        $this->lastName = $priest->last_name;
        $this->birthday = $priest->birthday;
        $this->address = $priest->address;
        $this->phoneNumber = $priest->phone_number;
        $this->email = $priest->email;
    }

    // Actualizar comunidad
    public function update()
    {
        $this->validate();

        if ($this->editId) {
            $priest = Priest::find($this->editId);
            $priest->update([
                'dpi' => $this->dpi,
                'name' => $this->name,
                'last_ame' => $this->lastName,
                'birthday' => $this->birthday,
                'address' => $this->address,
                'phone_number' => $this->phoneNumber,
                'email' => $this->email,
            ]);

            session()->flash('message', 'Community updated successfully.');
            $this->resetInput();
        }
    }

    // Eliminar comunidad
    public function delete($id)
    {
        Priest::find($id)->delete();
        session()->flash('message', 'Community deleted successfully.');
    }
}
