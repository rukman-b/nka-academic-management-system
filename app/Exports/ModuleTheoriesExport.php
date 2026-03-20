<?php

namespace App\Exports;

use App\Models\ModuleTheory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ModuleTheoriesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return ModuleTheory::with(['module', 'theory'])->get();
    }

    public function headings(): array
    {
        return [
            'Module',
            'Theory',
            'Teaching Notes',
            'Assigned At',
        ];
    }

    public function map($assignment): array
    {
        return [
            $assignment->module->name ?? '—',
            $assignment->theory->title ?? '—',
            $assignment->teaching_notes ?? '—',
            $assignment->created_at?->format('Y-m-d H:i'),
        ];
    }
}
