<?php

// File: app/Livewire/Traits/InteractsWithAddress.php
namespace App\Livewire\Traits;

trait InteractsWithAddress
{
    public function defaultAddress(): array
    {
        return [
            'address_line_1' => '',
            'address_line_2' => '',
            'town_or_city'   => '',
            'county'         => '',
            'postcode'       => '',
            'country'        => 'United Kingdom',
        ];
    }

    public function deleteAddressIfExists($model): void
    {
        if (method_exists($model, 'address') && $model->address) {
            $model->address->delete();
        }
    }

    protected function addressValidationRules(string $prefix = 'address.'): array
    {
        return [
            $prefix . 'address_line_1' => ['required', 'string', 'max:255'],
            $prefix . 'address_line_2' => ['nullable', 'string', 'max:255'],
            $prefix . 'town_or_city'   => ['required', 'string', 'max:255'],
            $prefix . 'county'         => ['nullable', 'string', 'max:255'],
            $prefix . 'postcode'       => ['required', 'string', 'max:20'],
            $prefix . 'country'        => ['required', 'string', 'max:100'],
        ];
    }
}
