<?php

namespace App\Support;

use App\Models\Semester;

class SemesterHelper
{

     /**
     * Retrieve all semesters for a given academic year.
     * 
     * Returns a collection of semesters if any exist, or `false` if none found.
     *
     * @param  string  $academic_year
     * @return \Illuminate\Support\Collection|false
     */

    public static function findSemestersByAcademicYear($academic_year)
    {
        $semesters = Semester::where('academic_year',$academic_year)->get();

            if($semesters->isEmpty())
            {                    
                return false;
            }

            return $semesters;
    }


    /**
     * Returns the first semester of the given academic year ordered by start date.
     * Returns false if no semester is found.
     *
     * @param string $academic_year
     * @return Semester|false
     */
    public static function findFirstSemesterOfAcademicYear(string $academic_year): Semester|false
    {
        $semester = Semester::where('academic_year', $academic_year)
                            ->orderBy('start_date')
                            ->first();

        return $semester ?: false;
    }


}