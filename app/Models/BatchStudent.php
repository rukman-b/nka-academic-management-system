<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class BatchStudent extends Pivot
{
    // Laravel 11: use Pivot class for advanced many-to-many tables
    protected $table = 'batch_student';

    protected $fillable = [
        'batch_id',
        'student_id',
        'status',
    ];

    public $timestamps = true;

    // Optional: if you're using UUIDs or custom keys, define primaryKey
    protected $primaryKey = 'id';

    // Relationships
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
