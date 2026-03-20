<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExperienceType extends Model
{
    protected $fillable = [
        'code',
        'label',
        'active',
    ];



    /**
 * Automatically cast database column types to native PHP types.
 * Ensures 'active' is treated as a true boolean in the application.
 */
    protected $casts = [
        'active' => 'boolean',
    ];
}
