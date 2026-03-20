<?php

namespace App\Exports;

use App\Models\Config;
use Maatwebsite\Excel\Concerns\FromCollection;

class ConfigsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Config::all()->map(function ($config) {
            return [
                'id'   => $config->id,
                'programme_id' => $config->programme->name,
                'delivery_type_id' => $config->deliveryType->label,
                'experience_type_id' => $config->experienceType->label,
                'name' => $config->name,
                'description' => $config->description,
                'duration' => $config->duration,
                'delivery_method' => $config->delivery_method,
                'language' => $config->language,
                'pass_marks' => $config->pass_marks,
                'status' => $config->status,
            ];
        });
    }

     public function headings(): array
    {
        return [
            'ID',
            'Programme Name',
            'Description',
            'Delivery Type',
            'Experience Type',
            'Config Name',
            'Description',
            'Duration',
            'Delivery Method',
            'Language',
            'Pass Mark',
            'Active',
           
        ];
    }
}
