<?php

namespace App\Exports;

use App\Models\Batch;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BatchesExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return Batch::with(['programme', 'config'])->get();
    }

    public function map($batch): array
    {
        return [
            $batch->id,
            $batch->code,
            $batch->programme->name,
            $batch->config->name,
            $batch->start_date,
            $batch->end_date,
            $batch->active ? 'Active' : 'Inactive',
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Batch Code',
            'Programme',
            'Config',
            'Start Date',
            'End Date',
            'Status',
        ];
    }
}
