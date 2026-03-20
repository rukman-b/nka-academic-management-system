<?php

namespace App\Exports;

use App\Models\Theory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TheoriesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Theory::with('department')
            ->get()
            ->map(function ($theory) {
                return [
                    'ID'         => $theory->id,
                    'Title'         => $theory->title,
                    'Department'     => $theory->department->name ?? '—',
                    'Created At' => $theory->created_at->format('Y-m-d'),
                    'Updated At' => $theory->updated_at->format('Y-m-d'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Department',
            'Created At',
            'Updated At',
        ];
    }
}
