<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'address_line_1',
        'address_line_2',
        'town_or_city',
        'county',
        'postcode',
        'country',
    ];

    public function addressable()
    {
        return $this->morphTo();
    }
}
