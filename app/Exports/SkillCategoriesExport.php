<?php

namespace App\Exports;

use App\Models\SkillCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SkillCategoriesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return SkillCategory::all()->map(function ($category) {
            return [
                'ID'          => $category->id,
                'Name'        => $category->name,
                'Description' => $category->description ?? '—',
                'Created At'  => $category->created_at->format('Y-m-d'),
                'Updated At'  => $category->updated_at->format('Y-m-d'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Description',
            'Created At',
            'Updated At',
        ];
    }
}
