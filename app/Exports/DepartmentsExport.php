<?php

namespace App\Exports;

use App\Models\Department;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DepartmentsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Department::with('address')->get()->map(function ($department) {
            return [
                'ID'             => $department->id,
                'Name'           => $department->name,
                // 'Email'          => $department->email,
                // 'Phone'          => $department->phone,
                'Address Line 1' => $department->address->address_line_1 ?? '',
                'Address Line 2' => $department->address->address_line_2 ?? '',
                'Town/City'      => $department->address->town_or_city ?? '',
                'County'         => $department->address->county ?? '',
                'Postcode'       => $department->address->postcode ?? '',
                'Country'        => $department->address->country ?? '',
                'Created At'     => $department->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            // 'Email',
            // 'Phone',
            'Address Line 1',
            'Address Line 2',
            'Town/City',
            'County',
            'Postcode',
            'Country',
            'Created At',
        ];
    }
}
