<?php

namespace App\Services;

use App\Models\ModuleSemester;
use App\Models\Semester;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

/**
 * Business logic for assigning modules to semesters.
 * Enforces NKA policies:
 * - A module can only be assigned once per academic year for each offering type (main or resit).
 * - Semester durations must be between configured minimum and maximum weeks.
 */
class ModuleSemesterService
{
    /**
     * Validates and creates a module-semester offering.
     *
     * @throws ValidationException
     */
    public function validateAndAssign(int $moduleId, int $semesterId, string $offeringType): void
    {
        $semester = Semester::findOrFail($semesterId);

        // Apply NKA policy validations
        $this->ensureSemesterDurationWithinRange($semester->start_date, $semester->end_date,$semester->name);
        $this->ensureUniqueOfferingPerYear($moduleId, $semester->academic_year, $offeringType);

        // Proceed with assignment
        ModuleSemester::create([
            'module_id' => $moduleId,
            'semester_id' => $semesterId,
            'offering_type' => $offeringType,
        ]);
    }

    /**
     * Enforce NKA's semester duration policy.
     */
    public function ensureSemesterDurationWithinRange(Carbon|string $start, Carbon|string $end,$semesterName): void
    {
        if(in_array(strtolower($semesterName), array_map('strtolower',config('nka.semester.exclude_duration_check')))) return; 
           
        $start = Carbon::parse($start);
        $end = Carbon::parse($end);

        $minWeeks = config('nka.semester.duration.min_num_weeks', 12); // inclusive
        $maxWeeks = config('nka.semester.duration.max_num_weeks', 18); // inclusive

        $days = $start->diffInDays($end); // total number of days
        $minDays = $minWeeks * 7; // 84
        $maxDays = $maxWeeks * 7; // 126

        if ($days < $minDays || $days > $maxDays) {
        throw ValidationException::withMessages([
            'semester' => "Semester duration must be {$minWeeks}–{$maxWeeks} weeks ({$minDays}–{$maxDays} days). You entered: {$days} days.",
            ]);
        }

    }



    /**
     * Prevent assigning a module more than once for the same offeringType in a year.
     */
    protected function ensureUniqueOfferingPerYear(int $moduleId, string $academicYear, string $offeringType): void
    {
        $exists = ModuleSemester::where('module_id', $moduleId)
            ->where('offering_type', $offeringType)
            ->whereHas('semester', fn ($q) =>
                $q->where('academic_year', $academicYear)
            )->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'semesterId' => "This module already has a '{$offeringType}' offering in academic year {$academicYear}.",
            ]);
        }
    }



     /**
     * Ensure that a named semester (Semester 1, 2, 3, or Full Year) 
     * only occurs once per academic year.
     *
     * This enforces NKA policy that each standard semester must be unique 
     * within a given academic year.
     *
     * @param string $name          The semester name (e.g., 'Semester 1').
     * @param string $academicYear  The academic year (e.g., '2025/2026').
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureUniqueSemesterPerAcademicYear(string $name, string $academicYear): void
    {
        // Case-insensitive check for Semester 1, 2, 3, and Full Year
        $allowed = config('nka.semester.semester_list');
        
        if (!in_array(Str::lower($name), $allowed)) {
            return; // skip check if name is something else (e.g., special semester)
        }

        $exists = Semester::whereRaw('LOWER(name) = ?', [Str::lower($name)])
            ->where('academic_year', $academicYear)
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'name' => "Only one '{$name}' can exist in academic year {$academicYear}.",
            ]);
        }
    }
}
