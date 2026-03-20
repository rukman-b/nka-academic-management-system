<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

//Traits
use App\Traits\FlushesCacheByTags;
use Illuminate\Support\Facades\Cache;

class Module extends Model
{

    use HasFactory,FlushesCacheByTags;

    
    protected $fillable = ['module_code','fheq_level_id','name','mark','lecturer_id','description']; 

    public function departments()
    {
        return $this->belongsToMany(\App\Models\Department::class, 'module_department');
    }

    public function getDepartmentsListAttribute()
    {
        return $this->departments->pluck('name')->join(', ');
    }


    // public function globalLevel()
    // {
    //     return $this->belongsTo(\App\Models\Level::class, 'global_level_id');
    // }

    public function practicals()
    {
        return $this->belongsToMany(Practical::class, 'module_practical')->withTimestamps();
    }


    public function practicalAssignments()
    {
        return $this->hasMany(ModulePractical::class);
    }


   public function theories()
   {
       return $this->belongsToMany(Theory::class, 'module_theory')->withPivot('teaching_notes')->withTimestamps();
   }

   public function skills()
   {
       return $this->belongsToMany(Skill::class)->withTimestamps();
   }

   public function semesters()
    {
        return $this->belongsToMany(Semester::class, 'module_semester');
    }

    public function moduleSemesters() 
    { 
        return $this->hasMany(ModuleSemester::class); 
    }

    public function fheqLevel()
    {
        return $this->belongsTo(Level::class, 'fheq_level_id');
    }

    public function configs()
    {
        return $this->belongsToMany(Config::class, 'config_modules');
    }

    public static function cachedList()
    {
        return Cache::tags(['module'])->remember(
            'module_ordered_by_name',
            config('nka.cacheTTL.long_term'),
            fn () => static::orderBy('name')->get()
        );
    }



}
