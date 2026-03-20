<?php

namespace App\Exports;

use App\Models\ModuleSemester;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ModuleSemesterExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return ModuleSemester::with(['module', 'semester'])->orderByDesc('created_at')->get();
    }

    public function map($row): array
    {
        return [
            $row->module->name ?? 'N/A',
            $row->semester->name ?? 'N/A',
            $row->semester->academic_year ?? 'N/A',
            ucfirst($row->offering_type), // Main or Resit
            $row->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Module',
            'Semester',
            'Academic Year',
            'Offering Type',
            'Assigned On',
        ];
    }
}
