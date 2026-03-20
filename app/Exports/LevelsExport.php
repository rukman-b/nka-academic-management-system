<?php

namespace App\Exports;

use App\Models\Level;
use Maatwebsite\Excel\Concerns\FromCollection;

class LevelsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Level::all()->map(function ($level) {
            return [
                'Rqf_level'   => $level->fheq_level,
                'Name' => $level->name,
                'Description' => $level->description,
            ];
        });
    }

     public function headings(): array
    {
        return [
            'Rqf_level',
            'Name',
            'Description'
           
        ];
    }
}
