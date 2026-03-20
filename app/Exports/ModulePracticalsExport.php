<?php

namespace App\Exports;

use App\Models\ModulePractical;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ModulePracticalsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return ModulePractical::with(['module', 'practical'])
            ->get()
            ->map(function ($item) {
                return [
                    'Module'      => $item->module->name ?? '—',
                    'Practical'   => $item->practical->title ?? '—',
                    'Created At'  => $item->created_at?->format('Y-m-d H:i'),
                    'Updated At'  => $item->updated_at?->format('Y-m-d H:i'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Module',
            'Practical',
            'Created At',
            'Updated At',
        ];
    }
}
