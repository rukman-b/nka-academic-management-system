<?php

namespace App\Exports;

use App\Models\Skill;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SkillsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Skill::with('skillCategory')->get()->map(function ($skill) {
            return [
                'ID'           => $skill->id,
                'Skill Name'   => $skill->name,
                'Description'  => $skill->description ?? '—',
                'Category'     => $skill->skillCategory->name ?? '—',
                'Created At'   => $skill->created_at->format('Y-m-d'),
                'Updated At'   => $skill->updated_at->format('Y-m-d'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Skill Name',
            'Description',
            'Category',
            'Created At',
            'Updated At',
        ];
    }
}
