<?php

namespace App\Exports;

use App\Models\Lalin;
use Maatwebsite\Excel\Concerns\FromCollection;

class LalinsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Lalin::all();
    }
}
