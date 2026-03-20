<?php

namespace App\Exports;

use App\Models\ConfigModule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ConfigModuleExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return ConfigModule::with(['config', 'module'])->get();
    }

    public function map($row): array
    {
        return [
            $row->config->code ?? 'N/A',
            $row->module->name ?? 'N/A',
            $row->is_optional ? 'Yes' : 'No',
            $row->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Config Code',
            'Module Name',
            'Is Optional',
            'Assigned On',
        ];
    }
}
