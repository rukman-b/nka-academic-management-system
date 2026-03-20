<?php

namespace App\Exports;

use App\Models\Programme;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProgrammesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Programme::with('department')->get()->map(function ($programme) {
            return [
                'ID'               => $programme->id,
                'Name'             => $programme->name,
                'Department'       => $programme->department->name,
            ];
        });
    }


    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Department'
           
        ];
    }
}
