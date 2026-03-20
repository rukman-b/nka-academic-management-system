<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchedulerLog extends Model
{
    protected $fillable = [
        'command',
        'started_at',
        'finished_at',
        'status',
        'output',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];
}
