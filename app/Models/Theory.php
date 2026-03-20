<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Theory extends Model
{

    use HasFactory;
    
    protected $fillable = ['department_id','title','description'];
    

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_theory')->withPivot('teaching_notes')->withTimestamps();
    }

   
}