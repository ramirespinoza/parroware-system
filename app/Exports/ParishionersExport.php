<?php

namespace App\Exports;

use App\Models\Parishioner;
use Maatwebsite\Excel\Concerns\FromCollection;

class ParishionersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Parishioner::with('assignedSacraments')->get();
    }
}
