<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

class Skill extends Model
{
    use HasFactory;
    
    protected $fillable = [
    'name',
    'description',
    'skill_category_id',
];


    public function skillCategory()
    {
        return $this->belongsTo(\App\Models\SkillCategory::class);
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class)->withTimestamps();
    }



}
