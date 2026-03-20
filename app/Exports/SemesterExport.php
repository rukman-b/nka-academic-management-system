<?php

namespace App\Exports;

use App\Models\Semester;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SemesterExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return Semester::orderBy('academic_year')->orderBy('name')->get();
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->academic_year,
            $row->start_date->format('Y-m-d'),
            $row->end_date->format('Y-m-d'),
            $row->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Semester',
            'Academic Year',
            'Start Date',
            'End Date',
            'Created On',
        ];
    }
}
