<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Practical extends Model
{
    use HasFactory;
    
    protected $fillable = ['title','description','department_id'];

    

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_practical')->withTimestamps();
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function moduleAssignments()
    {
        return $this->hasMany(ModulePractical::class);
    }


}
