<?php

namespace App\Exports;

use App\Models\ModuleSkill;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ModuleSkillsExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Fetch data for export.
     */
    public function collection()
    {
        return ModuleSkill::with(['module', 'skill'])->get();
    }

    /**
     * Map each row's data.
     */
    public function map($moduleSkill): array
    {
        return [
            $moduleSkill->id,
            $moduleSkill->module->name ?? '—',
            $moduleSkill->skill->name ?? '—',
            $moduleSkill->skill->skillCategory->name ?? '—',
            $moduleSkill->created_at?->format('Y-m-d H:i:s'),
            $moduleSkill->updated_at?->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Define column headings.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Module Name',
            'Skill Name',
            'Skill Category',
            'Created At',
            'Updated At',
        ];
    }
}
