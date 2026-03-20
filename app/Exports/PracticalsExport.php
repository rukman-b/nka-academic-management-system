<?php


namespace App\Exports;

use App\Models\Practical;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PracticalsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Practical::with('module')
            ->get()
            ->map(function ($practical) {
                return [
                    'ID'            => $practical->id,
                    'Name'          => $practical->name,
                    'Module'        => $practical->module->name ?? '—',
                    'Description'   => $practical->description ?? '—',
                    'Created At'    => $practical->created_at->format('Y-m-d'),
                    'Updated At'    => $practical->updated_at->format('Y-m-d'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Module',
            'Description',
            'Created At',
            'Updated At',
        ];
    }
}
