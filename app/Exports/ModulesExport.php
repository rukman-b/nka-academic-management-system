<?php

namespace App\Exports;

use App\Models\Module;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ModulesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        return Module::with('departments')->get()->map(function ($module) {
            return [
                'Code'              => $module->module_code,
                'Name'              => $module->name,
                'Global FHEQ  Level'  => $module->global_level_id,
                'Description'       => $module->description,
                'Departments'       => $module->departments->pluck('name')->join(', '),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Global FHEQ  Level',
            'Description',
            'Departments'
        ];
    }
}
