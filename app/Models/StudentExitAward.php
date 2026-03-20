<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentExitAward extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'programme_exit_award_id',
        'awarded_at',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function programmeExitAward()
    {
        return $this->belongsTo(ProgrammeExitAward::class);
    }
}
