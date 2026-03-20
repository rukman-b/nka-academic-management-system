<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

//Traits
use App\Traits\FlushesCacheByTags;


class ModuleSemester extends Model
{

    use FlushesCacheByTags;

    protected $fillable = ['module_id', 'semester_id', 'offering_type'];

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    public function isResit(): bool
    {
        return $this->offering_type === 'resit';
    }

    public static function cachedAssignedByDepartment(?int $departmentId)
    {
        $key = 'assigned_module_semesters_for_department_' . ($departmentId ?? 'all');

        return Cache::tags(['module_semesters'])->remember($key, config('nka.cacheTTL.long_term'), function () use ($departmentId) {
            return self::with(['module', 'semester'])
                ->when($departmentId, fn ($q) =>
                    $q->whereHas('module.departments', fn ($q2) =>
                        $q2->where('departments.id', $departmentId)
                    )
                )->get();
        });
    }

    public static function getCacheTagsToFlush(): string
    {
        return 'module_semesters';
    }

}
