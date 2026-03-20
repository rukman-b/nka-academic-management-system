<?php

namespace App\Exports;

use App\Models\BatchStudent;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BatchAssignmentsExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return BatchStudent::with(['student', 'batch.programme'])->get();
    }

    public function map($record): array
    {
        return [
            $record->student->name,
            $record->batch->code,
            $record->batch->programme->name ?? 'N/A',
            ucfirst($record->status),
            $record->created_at->format('Y-m-d'),
        ];
    }

    public function headings(): array
    {
        return [
            'Student Name',
            'Batch Code',
            'Programme',
            'Status',
            'Assigned At',
        ];
    }
}
