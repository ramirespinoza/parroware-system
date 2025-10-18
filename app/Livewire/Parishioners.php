<?php

namespace App\Livewire;

use App\Exports\ParishionersExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Community;
use Livewire\Component;
use App\Models\Parishioner;
use Livewire\WithPagination;

class Parishioners extends Component
{
    use WithPagination;

    //public $parishioners;
    public $dpi;
    public $name;
    public $lastName;
    public $birthday;
    public $address;
    public $phoneNumber;
    public $email;
    public $communityId;
    public $editId;

    public $communities;

    public $search = '';
    public $searchType = '';

    protected $updatesQueryString = ['search', 'searchType'];

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
            'communityId' => 'nullable|integer',
        ];
    }

    public function mount()
    {
        //$this->parishioners = Parishioner::all();
        $this->communities = Community::all();
    }

    public function render()
    {
        if($this->searchType == ''){
            return view('livewire.parishioners', ['parishioners' => Parishioner::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')
            ->orWhere('dpi', 'like', '%' . $this->search . '%')
            ->orWhere('phone_number', 'like', '%' . $this->search . '%')
            ->paginate(10)
        ]);
        }

        return view('livewire.parishioners', ['parishioners' => Parishioner::query()
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
        $this->communityId = 0;
        $this->editId = null;
    }

    // Crear nueva comunidad
    public function store()
    {
        $this->validate();

        Parishioner::create([
            'dpi' => $this->dpi,
            'name' => $this->name,
            'last_name' => $this->lastName,
            'birthday' => $this->birthday,
            'address' => $this->address,
            'phone_number' => $this->phoneNumber,
            'email' => $this->email,
            'community_id' => $this->communityId,
        ]);

        session()->flash('message', 'Feligres created successfully.');
        $this->resetInput();
    }

    // Cargar comunidad para editar
    public function edit($id)
    {
        $parishioner = Parishioner::findOrFail($id);
        $this->editId = $id;
        $this->dpi = $parishioner->dpi;
        $this->name = $parishioner->name;
        $this->lastName = $parishioner->last_name;
        $this->birthday = $parishioner->birthday;
        $this->address = $parishioner->address;
        $this->phoneNumber = $parishioner->phone_number;
        $this->email = $parishioner->email;
        $this->communityId = $parishioner->community_id;
    }

    // Actualizar comunidad
    public function update()
    {
        $this->validate();

        if ($this->editId) {
            $parishioner = Parishioner::find($this->editId);
            $parishioner->update([
                'dpi' => $this->dpi,
                'name' => $this->name,
                'last_ame' => $this->lastName,
                'birthday' => $this->birthday,
                'address' => $this->address,
                'phone_number' => $this->phoneNumber,
                'email' => $this->email,
                'community_id' => $this->communityId,
            ]);

            session()->flash('message', 'Community updated successfully.');
            $this->resetInput();
        }
    }

    // Eliminar comunidad
    public function delete($id)
    {
        Parishioner::find($id)->delete();
        session()->flash('message', 'Community deleted successfully.');
    }

    public function export()
    {
        $ldate = date('Y-m-d H:i:s');

        $fileName = 'parisioners'. $ldate . '.xlsx';
        return Excel::download(new ParishionersExport, $fileName);
    }


}
