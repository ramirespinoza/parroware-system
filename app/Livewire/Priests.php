<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Priest;
use Livewire\WithPagination;

class Priests extends Component
{
    use WithPagination;

    //public $priests;
    public $dpi;
    public $name;
    public $lastName;
    public $birthday;
    public $address;
    public $phoneNumber;
    public $email;
    public $editId;

    public $search = '';
    public $searchType = '';

    protected $updatesQueryString = ['search', 'searchType'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

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
        //$this->priests = Priest::all();
    }

    public function render()
    {
        if($this->searchType == ''){
            return view('livewire.priests', ['priests' => Priest::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')
            ->orWhere('dpi', 'like', '%' . $this->search . '%')
            ->orWhere('phone_number', 'like', '%' . $this->search . '%')
            ->paginate(10)
        ]);
        }

        return view('livewire.priests', ['priests' => Priest::query()
            ->where($this->searchType, 'like', '%' . $this->search . '%')
            ->paginate(10)]);

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
