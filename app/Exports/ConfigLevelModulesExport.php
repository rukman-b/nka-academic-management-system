<?php

namespace App\Exports;

use App\Models\ConfigLevelModule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ConfigLevelModulesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return ConfigLevelModule::with(['config.programme', 'level', 'module', 'lecturer'])
            ->get()
            ->map(function ($item) {
                return [
                    'Config Code'      => $item->config->name ?? '-',
                    'Programme'        => $item->config->programme->name ?? '-',
                    'Level'            => $item->level->name ?? '-',
                    'Module'           => $item->module->name ?? '-',
                    'Lecturer'         => $item->lecturer->name ?? 'Not Assigned',
                    'Marks'            => $item->marks ?? '-',
                    'Optional'         => $item->is_optional ? 'Yes' : 'No',
                    'Start Date'       => $item->start_date ?? '-',
                    'End Date'         => $item->end_date ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Config Code',
            'Programme',
            'Level',
            'Module',
            'Lecturer',
            'Marks',
            'Optional',
            'Start Date',
            'End Date',
        ];
    }
}
